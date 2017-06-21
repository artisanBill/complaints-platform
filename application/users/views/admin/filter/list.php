<div class="card">
    <form method="POST" action="users" accept-charset="UTF-8">
        <input name="_token" type="hidden" value="0cIjlaXtjdo9APqzT6EgdrKh1eTcTPgizEbdrtHq">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 30px;">
                            <label class="c-input c-checkbox">
                                <input data-toggle="all" type="checkbox">
                                <span class="c-indicator"></span>
                            </label>
                        </th>
                        <th>
                            <nobr>
                                <a href="users?order_by=display_name&amp;sort=asc">Display Name</a> <i class="glyphicons glyphicons-sorting text-muted"></i>
                            </nobr>
                        </th>
                        <th>
                            <nobr>
                                <a href="users?order_by=username&amp;sort=asc">Username</a> <i class="glyphicons glyphicons-sorting text-muted"></i>
                            </nobr>
                        </th>
                        <th>
                            <nobr>
                                <a href="users?order_by=email&amp;sort=asc">Email</a>
                                <i class="glyphicons glyphicons-sorting text-muted"></i>
                            </nobr>
                        </th>
                        <th>Status</th>
                        <th class="buttons">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="1">
                        <td>
                            <label class="c-input c-checkbox">
                                <input type="checkbox" name="id[]" value="1">
                                <span class="c-indicator"></span>
                            </label>
                        </td>

                        <td class="">Administrator</td>
                        <td class="">admin</td>
                        <td class="">admin@admin.com</td>
                        <td class="">
                            <span class="label label-sm label-success">Active</span>
                        </td>
                        <td class="text-lg-right">
                            <nobr>
                                <a class="btn btn-sm btn-warning  " href="users/edit/1">
                                    <i class="fa fa-pencil "></i>
                                    Edit
                                </a>
                                <a class="btn btn-sm btn-info  " href="users/permissions/1">
                                    <i class="fa fa-lock "></i>
                                    Permissions
                                </a>
                            </nobr>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="50%" style="padding: 10px;">

                            <div class="pull-left actions">
                                <button class="btn btn-sm btn-danger disabled " data-toggle="confirm" data-message="&lt;h3&gt;Are you sure you want to delete?&lt;/h3&gt;&lt;p&gt;This may adversely affect your system.&lt;/p&gt;" name="action" value="delete">
                                    <i class="fa fa-trash "></i>
                                    Delete
                                </button>
                            </div>
                            <div style="clear: both;"></div>
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </form>
</div>