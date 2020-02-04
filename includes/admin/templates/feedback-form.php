<form class="yatri-tools-demo-success-feedback">
    <label>
        <textarea class="feedback" name="feedback" placeholder="<?php
        esc_html_e('Do  you have any suggestion? You can give us feedback from here.')
        ?>"></textarea>
    </label>
    <p><?php esc_html_e('Clicking on send button will send your feedback message, admin email, website url and installed demo name.', 'yatri-tools'); ?></p>
    <input type="submit" class="button button-secondary" value="<?php esc_html_e('Send', 'yatri-tools'); ?>"/>
</form>