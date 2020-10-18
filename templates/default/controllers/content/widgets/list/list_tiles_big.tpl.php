<?php
/**
 * Template Name: LANG_WD_CONTENT_LIST_STYLE_TILES_BIG
 * Template Type: widget
 */

if ($items){ ?>

    <div class="widget_content_list tiles-big">
        <?php foreach($items as $item) { ?>

            <?php
                $url        = href_to($ctype['name'], $item['slug'] . '.html');
                $is_private = $item['is_private'] && $hide_except_title && !$item['user']['is_friend'];
                $image      = (($image_field && !empty($item[$image_field])) ? $item[$image_field] : '');
                if ($is_private) {
                    if($image_field && !empty($item[$image_field])){
                        $image = default_images('private', 'normal');
                    }
                    $url = '';
                }
            ?>

            <div class="item">
                <?php if ($image) { ?>
                    <div class="image">
                        <?php if ($url) { ?>
                            <a style="background-image:url('<?php echo html_image_src($image, 'normal', true); ?>')" href="<?php echo $url; ?>"></a>
                        <?php } else { ?>
                            <div style="background-image:url('<?php echo html_image_src($image, 'normal', true); ?>')"></div>
                        <?php } ?>
                    </div>
                <?php } ?>
                <div class="info">
                    <?php if ($is_show_details) { ?>
                        <div class="details">
                            <span class="author">
                                <a href="<?php echo href_to('users', $item['user']['id']); ?>"><?php html($item['user']['nickname']); ?></a>
                                <?php if ($item['parent_id']){ ?>
                                    <?php echo LANG_WROTE_IN_GROUP; ?>
                                    <a href="<?php echo rel_to_href($item['parent_url']); ?>"><?php html($item['parent_title']); ?></a>
                                <?php } ?>
                            </span>
                            <span class="date">
                                <?php html(string_date_age_max($item['date_pub'], true)); ?>
                            </span>
                            <?php if($ctype['is_comments']){ ?>
                                <span class="comments">
                                    <?php if ($url) { ?>
                                        <a href="<?php echo $url . '#comments'; ?>" title="<?php echo LANG_COMMENTS; ?>">
                                            <?php echo intval($item['comments']); ?>
                                        </a>
                                    <?php } else { ?>
                                        <?php echo intval($item['comments']); ?>
                                    <?php } ?>
                                </span>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <div class="title">
                        <?php if ($url) { ?>
                            <a href="<?php echo $url; ?>"><?php html($item['title']); ?></a>
                        <?php } else { ?>
                            <?php html($item['title']); ?>
                        <?php } ?>
                        <?php if ($item['is_private']) { ?>
                            <span class="is_private" title="<?php html(LANG_PRIVACY_HINT); ?>"></span>
                        <?php } ?>
                    </div>
                    <?php if ($teaser_field && !empty($item[$teaser_field])) { ?>
                        <div class="teaser">
                            <?php if (!$is_private) { ?>
                                <?php echo string_short($item[$teaser_field], $teaser_len); ?>
                            <?php } else { ?>
                                <!--noindex--><div class="private_field_hint"><?php echo LANG_PRIVACY_PRIVATE_HINT; ?></div><!--/noindex-->
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>

        <?php } ?>
    </div>

<?php } ?>