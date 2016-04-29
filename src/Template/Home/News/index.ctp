<div class="row" ng-controller="newsController">
    <div class="col-sm-6 col-md-4" ng-repeat="new in news">
        <div class="thumbnail">
            <img ng-src="{{new.cover}}" alt="{{new.title}}">
            <div class="caption">
                <h3>{{new.title}}</h3>
                <p>{{new.summary}}</p>
                <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
            </div>
        </div>
    </div>
</div>
<?php $this->start('script') ?>
<script>
    function newsController($scope){
        $scope.news = <?=$news?>;
    }
</script>
<?php $this->end('script');