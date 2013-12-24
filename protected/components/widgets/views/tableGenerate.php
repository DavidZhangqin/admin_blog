<div id="example_wrapper" class="dataTables_wrapper" role="grid">
<table id="<?php echo $this->getId();?>" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <?php foreach ($this->columns as $key => $value): ?> 
                <td>
                    <?php echo $value; ?>
                </td>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php $i=0; ?>
        <?php foreach ($this->datas as $key => $value): ?>
            <tr class="<?php echo $i++/2==0 ? 'odd' : 'even'; ?>">
                <?php foreach ($value as $k => $v): ?>
                    <td><?php echo $v; ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php
    $totalPage = $this->settings['displayLength'] != 0 ? ceil($this->totalCount/$this->settings['displayLength']) : 0;
    $currentPage = $this->settings['displayLength'] != 0 ? $this->offset/$this->settings['displayLength'] + 1 : 1;
    // $showPage = $this->settings['showPage'];
?>
<div class="row" style="margin-left:0px;">
    <div class="span6">
        <div class="dataTables_info" id="example_info">
            Showing <?php echo count($this->datas)==0?0:$this->offset+1; ?> to <?php echo $this->offset + count($this->datas); ?> of <?php echo $this->totalCount; ?> entries
        </div>
    </div>
    <div class="span6">
        <div class="dataTables_paginate paging_bootstrap pagination">
            <ul>
                <li class="prev <?php echo $currentPage == 1 ? 'disabled' : ''; ?>"><a href="<?php echo $currentPage == 1 ? '#' : $this->settings['requestSource'].'?offset='.($this->offset-$this->settings['displayLength']).'&displayLength='.$this->settings['displayLength']; ?>">← Previous</a></li>
                <?php 
                    if($currentPage-2 > 1) {
                        $startPage = $currentPage-2;
                    } else {
                        $startPage = 1;
                    } 
                    for ($i=$startPage; $i < $currentPage; $i++) { 
                        echo '<li><a href="'.$this->settings['requestSource'].'?offset='.($this->settings['displayLength']*($i-1)).'&displayLength='.$this->settings['displayLength'].'">'.$i.'</a></li>';
                    }
                    echo '<li class="active"><a href="'.$this->settings['requestSource'].'?offset='.($this->settings['displayLength']*($currentPage-1)).'&displayLength='.$this->settings['displayLength'].'">'.$i.'</a></li>';
                    if($currentPage + 2 < $totalPage) {
                        $endPage = $currentPage + 2;
                    } else {
                        $endPage = $totalPage;
                    }
                    for ($i=$currentPage+1; $i <= $endPage; $i++) { 
                        echo '<li><a href="'.$this->settings['requestSource'].'?offset='.($this->settings['displayLength']*($i-1)).'&displayLength='.$this->settings['displayLength'].'">'.$i.'</a></li>';
                    } 
                ?>
                <li class="next <?php echo $currentPage == $totalPage ? 'disabled' : ''; ?>"><a href="<?php echo $currentPage == $totalPage ? '#' : $this->settings['requestSource'].'?offset='.($this->offset+$this->settings['displayLength']).'&displayLength='.$this->settings['displayLength']; ?>">Next → </a></li>
            </ul>
        </div>
    </div>
</div>
</div>
