<style>
    #content {margin-top:-80px;padding:0 95px 90px;}

    .vote-option {width:560px;margin:0 auto;overflow:hidden;}

    #option-brief {overflow:hidden;}
    .option-brief, .option-actions {width:50%;float:left;}
        .option-brief>*:not(:last-child) {margin-bottom:30px;}
    .option-actions {margin-top:0;}
        .option-actions>a {float:right;clear:both;}
            .option-actions>a:not(:first-child) {margin-left:0;margin-top:30px;}

    .option-description {font-size:26px;line-height:46px;margin-top:26px;padding:1px;background-image:linear-gradient(#5250af,#2d2d8f);border-radius:20px;overflow:hidden;}
        .option-description section {background-color:#2b2971;border-radius:20px;padding:16px 26px;}

    .option-figure {padding:0;}
        .option-figure figure {width:520px;height:520px}
	/* 宽度在750像素以上的设备 */
	@media only screen and (min-width:751px)
	{
		
	}
	
	/* 宽度在960像素以上的设备 */
	@media only screen and (min-width:961px)
	{

	}

	/* 宽度在1280像素以上的设备 */
	@media only screen and (min-width:1281px)
	{

	}
</style>

<?php
    // 若为投票成功后进入的页面，提示已成功投票，并清除最近投票ID信息以避免重复提示
    if ($this->input->get('ballot_create_result') === 'succeed' && $this->session->last_ballot_created == $item['option_id']):
?>
<script>
    window.onload = function(){
        document.getElementById('vote-succeed').style.display = 'block';
    }
</script>
<?php
    $this->session->last_ballot_created = NULL;
    endif;
?>

<base href="<?php echo $this->media_root ?>">

<?php if ( empty($vote['url_image']) ): ?>
    <h1 id=vote-name><?php echo $vote['name'] ?></h1>
<?php else: ?>
    <figure id=vote-url_image class=vote-figure>
        <a href="<?php echo base_url('vote/detail?id='.$vote['vote_id']) ?>">
            <img alt="<?php echo $vote['name'] ?>形象图" src="<?php echo MEDIA_URL.'vote/'.$vote['url_image'] ?>">
        </a>
    </figure>
<?php endif ?>

<div id=content class=container>
	<?php if ( empty($item) ): ?>
	<p><?php echo $error ?></p>

	<?php else: ?>
    <div class=vote-option data-option_id="<?php echo $item['option_id'] ?>">

        <div id=option-brief>
            <div class=option-brief>
                <div class=option-id># <?php echo $item['option_id'] ?></div>
                <h2 class=option-name><?php echo $item['name'] ?></h2>
                <div class=ballot-count><span><?php echo $item['ballot_count'] ?></span> 票</div>
            </div>

            <div class=option-actions>
                <?php
                // 通用字符串
                $common_params = 'vote_id='.$item['vote_id'].'&option_id='.$item['option_id'];
                $common_attrs = 'data-vote_id='.$item['vote_id'].' data-option_id='.$item['option_id'];
                ?>
                <a class=option-detail <?php echo $common_attrs ?> href="#share-guide">推荐</a>
                <a class=_ballot-create <?php echo $common_attrs ?> href="<?php echo base_url('vote_ballot/create?'.$common_params) ?>">选TA</a>
            </div>
        </div>

        <!-- 候选项形象图 -->
        <div class=option-figure>
            <figure>
                <img src="<?php echo !empty($item['url_image'])? MEDIA_URL.'vote_option/'.$item['url_image']: MEDIA_URL.'vote/'.$vote['url_default_option_image'] ?>">
            </figure>
        </div>

        <!-- 候选项描述（若有） -->
        <?php if ( ! empty($item['description'])): ?>
            <div class=option-description>
                <section><?php echo $item['description'] ?></section>
            </div>
        <?php endif ?>
    </div>

	<?php endif ?>
</div>