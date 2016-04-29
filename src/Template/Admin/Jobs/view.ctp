<style>
    .text{
          line-height:20px;  
          text-indent:20px;
}
</style>
<div class="jobs view large-9 medium-8 columns content">
    <div class="row text">
        <?= htmlspecialchars_decode(h($job->job_desc)); ?>
    </div>
</div>
