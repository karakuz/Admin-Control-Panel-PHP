const options = {
  "responsive": true,
  "autoWidth": false,
  "processing": false,
  "serverSide": false,
  "pageLength" : 25,
  "ajax": "/ajax/setTable.php",

  responsive:{
    details: false
  },
  language: {
    searchPlaceholder: "Search records",
    search: "",
  },
  columnDefs: [
    {
      targets: 0,
      data: null,
      defaultContent: '<input type="checkbox" name="touchbutton" class="row-checkbox">',
      orderable: false,
      className: 'select-checkbox'
    },
    {
      targets: 8,
      "data": null,
      "defaultContent": `
        <div style="display: flex !important;">
          <button class="tiny ui primary basic button edit-button">Edit</button>
          <button class="tiny ui negative basic button delete-button">Delete</button>
        </div>
      `
    },
    { targets: 5, render: (price) => {return `$${price}`}},
    { targets: [2,3,4,5,6,7], className: "dt-head-center dt-body-center"},
    { className: "never", targets: [1,4] },
    { responsivePriority: 1, targets: 0 },
    { responsivePriority: 2, targets: 2 },
    { responsivePriority: 7, targets: 3 },
    { responsivePriority: 4, targets: 5 },
    { responsivePriority: 6, targets: 6 },
    { responsivePriority: 5, targets: 7 },
    { responsivePriority: 3, targets: 8 },
    { "width": "2%" , targets: 0 },
    { "width": "5%" , targets: [2,4,5] },
    { "width": "55%", targets: 3 },
    { "width": "13%", targets: 6 },
    { "width": "8%", targets: [7,8] },
  ],
};

const updateFormElements = document.forms.namedItem('edit').elements;
const updateInputs = Array.from(updateFormElements).slice(0,7);

const addNewFormElements = document.forms.namedItem('add-new-house').elements;
const addNewInputs = Array.from(addNewFormElements).slice(0,6);
let datatable, columns, IDs = [];

$(document).ready( () => {
  datatable = $('#datatable').DataTable(options);

  $('#top-checkbox').on('click', () => {
    if($('#top-checkbox').is(':checked'))
      handleCheckboxes("check");
    else
      handleCheckboxes("uncheck all");
  });

  $('#datatable tbody').on('click', '.row-checkbox', (element) => {
    const row = element.target.parentNode.parentNode;
    const checkbox = row.childNodes[0].childNodes[0];

    if(checkbox.checked){
      IDs.push(row.childNodes[1].innerHTML);
      selectRowOp(row);
    }
    else{
      colourizeRow(row);
      document.querySelector('#top-checkbox').checked = false;
      IDs.splice(IDs.indexOf(row.childNodes[1].innerHTML), 1);

      if(IDs.length === 0){
        document.querySelector('#delete-selected').lastChild.data = `Delete`;
        document.querySelector('#delete-selected').style.visibility = "hidden";
      }
      else
        document.querySelector('#delete-selected').lastChild.data = `Delete (${IDs.length})`;
    }
  });

  function handleCheckboxes(checkOrUncheckAll){
    const rows = Array.from(document.querySelector('tbody').childNodes);

    if(checkOrUncheckAll === "check")
      rows.forEach( row => {
        if(!IDs.includes(row.childNodes[1].innerHTML))
          IDs.push(row.childNodes[1].innerHTML);
        selectRowOp(row);
      });
    else{
      rows.forEach( row => colourizeRow(row) );
      IDs = [];
      document.querySelector('#delete-selected').lastChild.data = `Delete`;
      document.querySelector('#delete-selected').style.visibility = "hidden";
    }
  };

  function selectRowOp(row){
    const checkbox = row.childNodes[0].childNodes[0];
    row.style.backgroundColor = "#bfcce6";
    checkbox.checked = true;
    if($('#delete-selected').text() == "Delete")
      document.querySelector('#delete-selected').lastChild.data += ` (${IDs.length})`;
    else
      document.querySelector('#delete-selected').lastChild.data = `Delete (${IDs.length})`;
    document.querySelector('#delete-selected').style.visibility = "visible";
  }

  $('#datatable_wrapper').on('click', (element) => {
    const rows = Array.from(document.querySelectorAll('tbody > tr'));
    const targetTagName = element.target.tagName;
    if(targetTagName !== "TD" && 
      targetTagName !== "DIV" &&
      targetTagName !== "INPUT" || 
      element.target.type === "search"){
        rows.forEach( row => colourizeRow(row) );
        IDs = [];
        document.querySelector('#top-checkbox').checked = false;
        document.querySelector('#delete-selected').lastChild.data = `Delete`;
        document.querySelector('#delete-selected').style.visibility = "hidden";
      }
  });

  function colourizeRow(row){
    const checkbox = row.childNodes[0].childNodes[0];
    if(row.classList.contains("odd"))
      row.style.backgroundColor = "#f9f9f9";
    else
      row.style.backgroundColor = "#fff";
    checkbox.checked = false;
  }

  $('#datatable tbody').on('click', '.delete-button', (button) => {
    const ID = button.target.parentNode.parentNode.parentNode.childNodes[1].innerText;
    
    Swal.fire({
      title: 'Are you sure to delete?',
      text: "This action is irreversible",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes'
    })
    .then((result) => {
      if (result.isConfirmed){
        $.ajax({
          type: 'post',
          url: '/ajax/delete.php',
          data: `id=${ID}`,
          success: function(res){
            //console.log("res: " + res);
            if(res === "deleted"){
              Swal.fire({
                icon: 'success',
                text: 'Data has been deleted',
                showConfirmButton: false,
                timer: 1500
              });
            }
            else
              Swal.fire({icon: "error", text: "Something went wrong"});
            datatable.ajax.reload();
          }
        });
      }
    });
  });

  
  $('#datatable tbody').on('click', '.edit-button', (button) => {
    columns = button.target.parentNode.parentNode.parentNode.childNodes;
    setModal(columns);
  });

  $('.dt-custom-buttons').on('click', '#add-new', () => $('#add-new-modal').modal('show'));

  function setModal(columns){
    $('input#edit-id').val(columns[1].innerText);
    $('input#edit-name').val(columns[2].innerText);
    $('input#edit-address').val(columns[3].innerText);
    $('textarea#edit-description').val(columns[4].innerText);
    $('input#edit-price').val(columns[5].innerText.replace('$',''));

    handleDropdown('edit-rooms', columns[6].innerText);
    handleDropdown('edit-housetypes', columns[7].innerText);

    $('#edit-modal').modal('show');
  }

  function handleDropdown(tagID, val){
    $(`input#${tagID}`).val(val);
    $(`div#${tagID+"-dp"} > div.text`).text(val);
    const dropdownItems = Array.from(document.querySelectorAll(`div#${tagID+"-dp"}>div:last-child>div`));
    for(let dropdownItem of dropdownItems){
      if(dropdownItem.classList.contains("selected")){
        dropdownItem.classList.remove("active");
        dropdownItem.classList.remove("selected");
      }
      if(dropdownItem.innerText == val){
        dropdownItem.classList.add("active");
        dropdownItem.classList.add("selected");
      }
    }
  }

  function clearModal(){
    for(let input of addNewInputs){
      input.value = "";
    }
    document.querySelector('#edit-rooms-dp > .text').innerHTML = "Rooms";
    document.querySelector('#edit-rooms-dp').setAttribute('style', 'border: 1px solid rgba(34,36,38,.15) !important;');
    document.querySelector('#edit-housetypes-dp > .text').innerHTML = "Type";
    document.querySelector('#edit-housetypes-dp').setAttribute('style', 'border: 1px solid rgba(34,36,38,.15) !important;');
  }

  $('#edit-modal-cancel-button').click( () => {
    $('#edit-modal').modal('hide');
  });

  $('#edit-modal-reset-button').click( () => {
    setModal(columns);
    for(let input of updateInputs)
      input.setAttribute('style', 'border: 1px solid rgba(34,36,38,.15) !important;');
  });

  $('#add-modal-cancel-button').click( () => {
    $('#add-new-modal').modal('hide');
  });

  $('#add-modal-reset-button').click( () => {
    clearModal();
    for(let input of addNewInputs)
      input.setAttribute('style', 'border: 1px solid rgba(34,36,38,.15) !important;');
    document.querySelector('#add-rooms-dp > .text').innerHTML = "Rooms";
    document.querySelector('#add-rooms-dp').setAttribute('style', 'border: 1px solid rgba(34,36,38,.15) !important;');
    document.querySelector('#add-housetypes-dp > .text').innerHTML = "Type";
    document.querySelector('#add-housetypes-dp').setAttribute('style', 'border: 1px solid rgba(34,36,38,.15) !important;');
  });

  setTimeout( () => {
    document.querySelector('#loading').classList.remove('active');
  },1000);
});

/*----------------------------------------------
************************************************
***************document.ready END***************
************************************************
-----------------------------------------------*/

$('#delete-selected').click( () => {
  Swal.fire({
      title: `Are you sure to delete ${IDs.length} item(s)?`,
      text: "This action is irreversible",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes'
    })
    .then((result) => {
      if (result.isConfirmed){
        $.ajax({
          type: 'post',
          url: '/ajax/delete.php',
          data: {ids: IDs},
          success: function(res){
            //console.log("res: " + res);
            if(res === "deleted"){
              Swal.fire({
                icon: 'success',
                text: 'Data has been deleted',
                showConfirmButton: false,
                timer: 1500
              });
              document.querySelector('#top-checkbox').checked = false;
            }
            else
              Swal.fire({icon: "error", text: "An error occured"});
            datatable.ajax.reload();
            IDs = [];
            document.querySelector('#delete-selected').lastChild.data = `Delete`;
            document.querySelector('#delete-selected').style.visibility = "hidden";
          }
        });
      }
    });
});

$('button#edit-modal-update').click( () => {
  if(validateForm(updateFormElements))
    $('form#edit').trigger("submit");
});

$(document).on("submit", 'form#edit', event => {
  event.preventDefault();
  //console.log($('form#edit').serialize() + '&update=1');
  
  $.ajax({
    type: 'post',
    url: '/ajax/crud.php',
    data: $('form#edit').serialize() + '&update=1',
    success: function (res) {
      //console.log(res);
      if(res === "true"){
        Swal.fire({ icon: 'success', text: 'Update has been done', showConfirmButton: false,timer: 1500});
        datatable.ajax.reload();
        $('#edit-modal').modal('hide');
      }
      else
        Swal.fire({icon: "error", text: "An error happened while updating"});
    },
    error: () => Swal.fire({icon: "error", text: "An error happened while updating"})
  });
})

$('button#add-modal-submit').click( () => {
  if(validateForm(addNewFormElements))
    $('form#add-new-house').trigger("submit");
});

$(document).on("submit", 'form#add-new-house', event => {
  event.preventDefault();
  
  $.ajax({
    type: 'post',
    url: '/ajax/crud.php',
    data: $('form#add-new-house').serialize() + '&add=1',
    success: function (res) {
      //console.log(res);
      if(res === "true"){
        Swal.fire({ icon: 'success', text: 'Success!', showConfirmButton: false, timer: 1500});
        datatable.ajax.reload();
        $('#add-new-modal').modal('hide');
      }
      else
        Swal.fire({icon: "error", text: "An error occured while submitting"});
    },
    error: () => Swal.fire({icon: "error", text: "An error occured while submitting"})
  });
})

function validateForm(formElements){
  const inputs = Array.from(formElements).slice(0,6);
  let isMissing = false;

  for(let input of inputs){
    if(input.value === ''){
      if(input.type == "hidden")
        input.parentNode.setAttribute('style', 'border: 1px solid red !important');
      else
        input.setAttribute('style', 'border: 1px solid red !important');
      isMissing = true;
    }
  }
  
  if(isMissing){
    Swal.fire({icon: "error", text: "Fill the missing inputs before updating"});
    return false;
  }
  return true;
}

for(let input of updateInputs)
  input.addEventListener('input', (e) => e.target.setAttribute('style',"border: 1px solid rgba(34,36,38,.15)"));
for(let input of addNewInputs)
  input.addEventListener('input', (e) =>  e.target.setAttribute('style',"border: 1px solid rgba(34,36,38,.15)"));

document.querySelector('#edit-rooms-dp').addEventListener('click', () => { document.querySelector('#edit-rooms-dp').setAttribute('style',"border: 1px solid rgba(34,36,38,.15)") })
document.querySelector('#edit-housetypes-dp').addEventListener('click', () => { document.querySelector('#edit-housetypes-dp').setAttribute('style',"border: 1px solid rgba(34,36,38,.15)") })
document.querySelector('#add-rooms-dp').addEventListener('click', () => { document.querySelector('#add-rooms-dp').setAttribute('style',"border: 1px solid rgba(34,36,38,.15)") })
document.querySelector('#add-housetypes-dp').addEventListener('click', () => { document.querySelector('#add-housetypes-dp').setAttribute('style',"border: 1px solid rgba(34,36,38,.15)") })