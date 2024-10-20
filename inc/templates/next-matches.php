<?php
// Add Customizer Option to Enable/Disable the Next Matches Section
function customize_next_matches_section( $wp_customize ) {
    // Add Section for Next Matches
    $wp_customize->add_section( 'next_matches_section', array(
        'title'       => __( 'Next Matches' ),
        'description' => __( 'Settings for the Next Matches section' ),
        'priority'    => 160,
    ));

    // Add Setting to Enable/Disable the Next Matches Section
    $wp_customize->add_setting( 'next_matches_active', array(
        'default'           => 1, // Enabled by default
        'sanitize_callback' => 'absint',
    ));

    // Add Control for Enable/Disable
    $wp_customize->add_control( 'next_matches_active', array(
        'label'    => __( 'Enable Next Matches Section' ),
        'section'  => 'next_matches_section',
        'type'     => 'checkbox',
    ));

    // Add Setting to Control the Number of Matches
    $wp_customize->add_setting( 'next_matches_count', array(
        'default'           => 5,
        'sanitize_callback' => 'absint', // Sanitize input as integer
    ));

    // Add Control for Number of Matches
    $wp_customize->add_control( 'next_matches_count', array(
        'label'   => __( 'Number of Matches to Display' ),
        'section' => 'next_matches_section',
        'type'    => 'number',
    ));
}
add_action( 'customize_register', 'customize_next_matches_section' );

// Function to Get Next Matches
function get_next_matches( $count ) {
    $today = current_time( 'Y-m-d H:i:s' );
    $args = array(
        'post_type'      => 'matches',
        'meta_key'       => 'match_time',
        'orderby'        => 'meta_value',
        'order'          => 'ASC',
        'meta_query'     => array(
            array(
                'key'     => 'match_time',
                'value'   => $today,
                'compare' => '>=', // Show matches that are upcoming
                'type'    => 'DATETIME',
            ),
        ),
        'posts_per_page' => $count, // Number of matches to display
    );
    $matches_query = new WP_Query( $args );
    return $matches_query;
}

// Function to Display the Next Matches Section
function display_next_matches() {
    // Check if the Next Matches Section is enabled in the Customizer
    if ( ! get_theme_mod( 'next_matches_active', 1 ) ) {
        return; // Exit if the section is disabled
    }

    // Get the number of matches to display from the Customizer
    $count = get_theme_mod( 'next_matches_count', 5 ); // Default to 5 if not set
    $next_matches = get_next_matches( $count );

    echo '<div class="marquee-container">';
     // Next Matches title aligned to the right
     echo '<div class="next-matches-title">Next Matches</div>';
    // Scrolling next matches in the marquee
    echo '<marquee behavior="scroll" direction="left" class="matches-marquee">';
    while ( $next_matches->have_posts() ) {
        $next_matches->the_post();
        $team_1 = get_post_meta( get_the_ID(), 'team_1', true );
        $team_2 = get_post_meta( get_the_ID(), 'team_2', true );
        $match_time = get_post_meta( get_the_ID(), 'match_time', true );
        $venue = get_post_meta( get_the_ID(), 'venue', true );

        echo '<span class="match-info">';
        echo '<strong>' . esc_html( $team_1 ) . '</strong> vs <strong>' . esc_html( $team_2 ) . '</strong>';
        echo ' - ' . date( 'F j, Y, g:i a', strtotime( $match_time ) ) . ' at ' . esc_html( $venue );
        echo '</span> &nbsp;&nbsp;&nbsp;&nbsp;';
    }
    echo '</marquee>';


    // Dropdown with all matches
    $all_matches = get_next_matches( -1 ); // Get all upcoming matches (no limit)
    if ( $all_matches->have_posts() ) {
        echo '<div class="matches-dropdown-container">';
        echo '<button class="dropdown-toggle">All Matches</button>';
        echo '<div class="matches-dropdown">';
        while ( $all_matches->have_posts() ) {
            $all_matches->the_post();
            $team_1 = get_post_meta( get_the_ID(), 'team_1', true );
            $team_2 = get_post_meta( get_the_ID(), 'team_2', true );
            $match_time = get_post_meta( get_the_ID(), 'match_time', true );

            echo '<a href="' . get_permalink() . '">';
            echo esc_html( $team_1 ) . ' vs ' . esc_html( $team_2 ) . ' - ' . date( 'F j, Y, g:i a', strtotime( $match_time ) );
            echo '</a>';
        }
        echo '</div>'; // Close the dropdown
        echo '</div>'; // Close dropdown container
    }
echo '</div>'; // Close marquee container

    wp_reset_postdata(); // Reset the global post object
}
