    <div id="footer">
        <div class="url_link">
            <dl>
                <dt><strong>友情链接</strong></dt>
                <dd>
                <?php foreach ($this->config->item('view')['url_link_list'] as $k => $v): ?>
                    <a href="<?php echo $v['url_link']; ?>" target="_blank"><?php echo $v['title']; ?></a>
                <?php endforeach; ?>
                </dd>
            </dl>
        </div>
        <div class="copyright"><?php echo $this->config->item('view')['footer']; ?></div>
    </div>
</body>
</html>