<div class="ui modal" id="add-new-modal">
  <form class="ui form p-2r" id="add-new-house">
    <h1 class="ui dividing header p-2r-0">Add New House</h1>
    <div class="field mt-2r">
      <div class="three fields">
        <div class="four wide field">
          <label class="fs-2r">Name</label>
          <input type="text" name="house_name" placeholder="Name" id="add-new-name">
        </div>
        <div class="four wide field pos-rel">
          <label class="fs-2r">Price</label>
          <span class="modal-price-sign">$</span>
          <input type="number" name="price" step="1" placeholder="Price" id="add-new-price" style="padding-left: 1.2rem !important;">
        </div>
        <div class="four wide field">
          <label class="fs-2r">Rooms</label>
          <div class="ui selection dropdown" id="add-rooms-dp" style="min-width: unset;">
            <input type="hidden" name="room" id="add-new-rooms">
            <i class="dropdown icon"></i>
            <div class="default text">Rooms</div>
            <div class="menu" style="position: absolute;">
              <?php 
                $rooms = $db->getDropdownItems("rooms");
                foreach ($rooms as $room):
              ?>
                <div class="item" data-value=<?php echo $room['room']?>><?php echo $room['room']?></div>
              <?php endforeach;?>
            </div>
          </div>
        </div>
        <div class="four wide field">
          <label class="fs-2r">House Type</label>
          <div class="ui selection dropdown" id="add-housetypes-dp" style="min-width: unset;">
            <input type="hidden" name="house_type" id="add-new-housetypes"> 
            <i class="dropdown icon"></i>
            <div class="default text" id="add-type-default">Type</div>
            <div class="menu" style="position: absolute;">
              <?php 
                $types = $db->getDropdownItems("house_types");
                foreach ($types as $type):
              ?>
                <div class="item" data-value=<?php echo $type['house_type']?>><?php echo $type['house_type']?></div>
              <?php endforeach;?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="field mt-2r">
      <label class="fs-2r">Address</label>
      <input type="text" name="address" placeholder="Address" id="add-new-address">
    </div>
    <div class="field mt-2r">
      <label class="fs-2r">Description</label>
      <textarea name="description" id="add-new-description" placeholder="Description" rows="5"></textarea>
    </div>

    <div class="df-jcsb mt-2r" style="margin: 0 auto; max-width: 310px;">
      <button type="button" class="ui button" id="add-modal-reset-button">Reset</button>
      <button type="button" class="ui primary button" id="add-modal-submit">Submit</button>
      <button type="button" class="ui red button" id="add-modal-cancel-button">Cancel</button>
    </div>
  </form>
</div>