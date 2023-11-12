<?php
class Delete_modal
{
    private $idAttr;
    private $deleteUrl;
    private $warnInfo;
    private $modalTitle;
    private $className;
    private $current_delete_item_id;
    private $modal_target;
    private $modal_temp;
    private $btn_temp;

    public function get_delete_modal_btn($id) {
        $this->current_delete_item_id = $id;
        $this->gen_delete_button();
        return $this->btn_temp;
    }
    public function insert_delete_modal_btn($id) {
        $this->current_delete_item_id = $id;
        $this->gen_delete_button();
        echo $this->btn_temp;
    }

    public function __construct($deleteUrl, $warnInfo, $modalTitle, $className='delete_link', $idAttr='del_id')
    {
        $this->className = $className;
        $this->idAttr = $idAttr;
        $this->deleteUrl = $deleteUrl;
        $this->warnInfo = $warnInfo;
        $this->modalTitle = $modalTitle;
        $ranInt = random_int(0, 9999);
        $this->modal_target = $modalTitle . (string)$ranInt . $idAttr;
        $this->gen_delete_modal();
        echo $this->modal_temp;
    }

    private function gen_delete_button()
    {
        $this->btn_temp = "<a $this->idAttr={$this->current_delete_item_id} data-toggle='modal' data-target='#$this->modal_target' class='btn btn-danger $this->className'>Delete</a>";
    }

    private function gen_delete_modal()
    {
        $this->modal_temp = "
<!-- Modal -->
<div class='modal fade' id='$this->modal_target' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLabel'>$this->modalTitle</h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body'>
                $this->warnInfo
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cance</button>
                <a  class='btn btn-primary doit'>Delete</a>
            </div>
        </div>
    </div>
</div>

<script src='js/jquery.js'></script>
<script>

    $(document).ready(function (){
        $('.'+ '$this->className').on('click', function (){
            const id = $(this).attr('$this->idAttr');         
             $('.doit').attr('href', '$this->deleteUrl'+ id)
        });
    });
</script>
    ";
    }
}
