<section id="push">

    <a href="#" data-dismiss="push-menu" class="dismiss"><i class="fa fa-times-circle "></i></a>
    <div class="container-fluid">

        <div class="row">

            <div class="col-md-10">
                <form method="get" action="{{ url('admin/search') }}">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search..." name="filter_term">
                        <span class="input-group-addon">
                            <i class="fa fa-search "></i>
                        </span>
                    </div>
                </form>
            </div>

            <div class="col-md-14 modules">
                <div class="row">
                    <?php foreach ( $adminNavigation as $nav => $url ): ?>
                    <div class="col-sm-6">
                        <a class="nav-link active" href="">
                            <?php echo ucfirst($nav) ?>
                        </a>
                    </div>
                    <?php endforeach ?>
                </div>
            </div>

        </div>

    </div>
</section>