<div id="deleteModal" class="modal">
    <div class="modal-content">
        <h4>Delete</h4>
        <p>This will permanently remove record from database.</p>
    </div>
    <div class="modal-footer">
        <form id="deleteForm" action="?controller=tables&action=delete" method="post">
            <input type="hidden" id="deleteId" name="id" value=""/>
            <a href="#" onclick="sendDeleteForm()" class="modal-action modal-close red waves-effect waves-red btn">Delete</a>
            <a href="#!" class="modal-close btn-flat ">Cancel</a>
        </form>
    </div>
</div>
