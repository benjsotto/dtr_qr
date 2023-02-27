
        <div style="width: 100%;" id="table_head">

            <div class="title_right">
                <div class="col-md-3 col-sm-3 col-xs-6 form-group pull-right top_search">
                        <div class="input-group">
                                <input type="text" class="form-control search" title="Enter keyword" id='search_event_list' placeholder="Search for..." style="border: 1px solid #ccc;">
                                <span class="input-group-btn">
                                  <button class="btn btn-default" type="button" style="border: 1px solid #ccc;">Go!</button>
                                </span>
                        </div>
                </div>
            </div>

            <?php 
            if(@$limit){} else { ?>
                <?php $entry_per_page = @$entry_per_page ? $entry_per_page : 10; ?>
                <select id="limit" class="form-control input-sm m-bot15" style="width: 70px; display: inline-block; height: 34px; vertical-align: middle; margin-top: 6px; margin-bottom: 0;">
                    <option value="10" <?php echo ($entry_per_page==10) ? 'selected' : ''; ?>>10</option>
                    <option value="25" <?php echo ($entry_per_page==25) ? 'selected' : ''; ?>>25</option>
                    <option value="50" <?php echo ($entry_per_page==50) ? 'selected' : ''; ?>>50</option>
                    <option value="100" <?php echo ($entry_per_page==100) ? 'selected' : ''; ?>>100</option>
                    <option value="all" <?php echo ($entry_per_page=='all') ? 'selected' : ''; ?>>All</option>
                </select> 
                <span style="display: inline-block;">entries per page</span>
            <?php } ?>

            <input type="hidden" id="order_by" value="">
            <input type="hidden" id="sort_by" value="">

        </div>

        <br/>

        <div id="load_result" style="min-height: 300px;"></div>
