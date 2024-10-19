<footer class="site-footer">
    <div class="container">
        <div class="footer-widgets">
            <div class="footer-widget-area">
                <?php if (is_active_sidebar('footer-widget-1')) : ?>
                    <div class="footer-widget-1">
                        <?php dynamic_sidebar('footer-widget-1'); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="footer-widget-area">
                <?php if (is_active_sidebar('footer-widget-2')) : ?>
                    <div class="footer-widget-2">
                        <?php dynamic_sidebar('footer-widget-2'); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="footer-widget-area">
                <?php if (is_active_sidebar('footer-widget-3')) : ?>
                    <div class="footer-widget-3">
                        <?php dynamic_sidebar('footer-widget-3'); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="footer-widget-area">
                <?php if (is_active_sidebar('footer-widget-4')) : ?>
                    <div class="footer-widget-4">
                        <?php dynamic_sidebar('footer-widget-4'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
	<hr>
	<p>&copy; <?php echo date('Y'); ?> Tournament Name. All rights reserved.</p>
<?php wp_footer(); ?>
</footer>
</body>
</html>
