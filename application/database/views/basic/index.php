<div class="container-fluid">
    <div class="card">
        <div class="card-block">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>名称</th>
                            <th>描述</th>
                            <th class="buttons">&nbsp;</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td><?php echo lang('brocade.mysqlVersion'); ?></td>
                            <td><?php echo mysqli_get_client_info(); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo lang('brocade.mysqlHost'); ?></td>
                            <td><?php echo mysqli_get_host_info($this->db->db_connect()); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo lang('brocade.dbEncoding'); ?></td>
                            <td><?php echo mysqli_character_set_name($this->db->db_connect()); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo lang('brocade.mysqlProtocol'); ?></td>
                            <td><?php echo mysqli_get_proto_info($this->db->db_connect()); ?></td>
                        </tr>
                        <?php foreach( $stats as $stat => $value ): ?>
                        <tr>
                            <td><?php echo $stat; ?></td>
                            <td><?php echo $stat == 'Uptime' ? gmdate('H:i:s', $value) : $value; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>

                    <tfoot>
                        <tr>
                            <th colspan="50%" style="padding: 10px;">

                                <div class="pull-left actions"></div>

                                <div style="clear: both;"></div>

                            </th>
                        </tr>
                    </tfoot>

                </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-block">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><?php echo lang('boone.user');?></th>
                            <th><?php echo lang('boone.host');?></th>
                            <th><?php echo lang('boone.command');?></th>
                            <th><?php echo lang('boone.time');?></th>
                            <th><?php echo lang('boone.state');?></th>
                            <th><?php echo lang('boone.info');?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($processes as $process ): ?>
                        <tr>
                            <td><?php echo $process->User; ?></td>
                            <td><?php echo $process->Host; ?></td>
                            <td><?php echo $process->Command; ?></td>
                            <td><?php echo gmdate('H:i:s', $process->Time); ?></td>
                            <td><?php echo $process->State; ?></td>
                            <td><?php echo $process->Info; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>