<?php get_header(); ?>

<div class="container">
    <section class="match-cards">
        <h2>Upcoming Matches</h2>
        <div class="match-cards-inner">
            <?php
            $args = array(
                'post_type' => 'matches',
                'posts_per_page' => 4,
            );
            $matches = new WP_Query($args);
            if ($matches->have_posts()) :
                while ($matches->have_posts()) : $matches->the_post();
                    ?>
                    <div class="match-card">
                        <h3><?php echo esc_html(get_post_meta(get_the_ID(), 'team_1', true)); ?> vs <?php echo esc_html(get_post_meta(get_the_ID(), 'team_2', true)); ?></h3>
                        <p>Time: <?php echo esc_html(get_post_meta(get_the_ID(), 'match_time', true)); ?></p>
                        <p>Venue: <?php echo esc_html(get_post_meta(get_the_ID(), 'venue', true)); ?></p>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <p>No upcoming matches found.</p>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </section>
</div>

<?php get_footer(); ?>
