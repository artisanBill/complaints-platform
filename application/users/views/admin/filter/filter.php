<div class="card card-container">
    <form method="GET" action="users" accept-charset="UTF-8" id="filters" class="form-inline">
        <input type="hidden" name="view" value="all">
        <div class="form-group">
            <input class="form-control" placeholder="Search" name="filter_search" type="text"></div>
        <div class="form-group">
            <select class="c-select form-control" name="filter_roles">
                <option value="" disabled="" selected="">Roles</option>
                <option value="1">Admin</option>
                <option value="3">Guest</option>
                <option value="2">User</option>
            </select>
        </div>
        <div class="form-group">
            <select class="c-select" name="filter_status">
                <option value="" disabled="" selected="">Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
                <option value="disabled">Disabled</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success"> <i class="fa fa-filter "></i>
            Filter
        </button>
        <a href="users" class="btn btn-secondary-outline"> <i class=" "></i>
            Clear
        </a>
    </form>
</div>