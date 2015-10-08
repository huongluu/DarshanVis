<div class="modal fade" id="sorting_modal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" style="width:680px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Sort</h4>
            </div>
            <div class="modal-body">
                <center>
                    <?php include '_sorting.php'; ?>
                </center>
            </div>
            <div class="modal-footer">
                <center>
                    <button type="button" id="sorting-button" class="btn btn-default" data-dismiss="modal">OK</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </center>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
