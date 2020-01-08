<div class="container">
    <div class="template-page content  av-content-full alpha units">
        <div class="well">
            <form class="" method="get" id="download" action="<?php echo site_url().'/youtube-video-to-mp3-convert'; ?>">
                <h1 class="form-download-heading"><?php echo __('Youtube to mp3 Converter', 'yttmp3'); ?></h1>
                    <div class="input-group">
                      <input type="text" name="videoid" id="videoid" style="margin-bottom: 0px;" required="required" class="form-control input-lg" placeholder="<?php echo __('YouTube Link or VideoID', 'yttmp3'); ?>" autofocus>
                        <input type="hidden" name="type" id="type" value="Download"/>
                        <span class="input-group-btn">
                        <input class="btn btn-primary btn-lg" type="submit" style="padding: 11px 22px;" name="submit" value="<?php echo __('Convert', 'yttmp3'); ?>" />
                      </span>
                    </div><!-- /input-group -->
                <div class="video-info">
                    <p><?php echo __('Valid inputs are YouTube links or VideoIDs:', 'yttmp3'); ?></p>
                    <ul>
                        <li><?php echo __('youtube.com/watch?v=...', 'yttmp3'); ?></li>
                        <li><?php echo __('youtu.be/...', 'yttmp3'); ?></li>
                        <li><?php echo __('youtube.com/embed/...', 'yttmp3'); ?></li>
                        <li><?php echo __('youtube-nocookie.com/embed/...', 'yttmp3'); ?></li>
                        <li><?php echo __('youtube.com/watch?feature=player_embedded&v=...', 'yttmp3'); ?></li>
                    </ul>
                </div>
                <hr />
            <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>