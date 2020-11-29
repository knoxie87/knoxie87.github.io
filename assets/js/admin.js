getUsers();

//displaying user reset passwordd form
async function displayPasswordBox(id) {
  await w3.getHttpObject(`/admin/user/?id=${id}`,displayPasswordBoxform);
}
async function displayPasswordBoxform(data) {
  await w3.displayObject("password-box-form", data); 
  w3.removeClass('#password-box-form','w3-hide')
}

//displaying user add form
async function getUsers() {
 await w3.getHttpObject("/admin/users", displayUsers);
}
async function displayUsers(data) { 
 await w3.displayObject("users", data); 
 w3.removeClass('#users','w3-hide')
}
function displayUserAddForm(e) {
    e.preventDefault();
    let editform=  document.getElementById("user-edit-form");
    let addform = document.getElementById("user-add-form");
    editform.classList.add("w3-hide");
    addform.classList.remove("w3-hide");
}

//displaying user edit form
async function getUser(id){
  await w3.getHttpObject(`/admin/user/?id=${id}`,displayUserEditForm);
}
async function displayUserEditForm(data) {
  w3.removeClass('#user-edit-form','w3-hide');
  await w3.displayObject("user-edit-form", data); 
}




async function addUser(e) { 
  e.preventDefault();
  let formData = new FormData(document.getElementById("user-add-form")); 
  fetch("/admin/user/add", {
    method: "post",
    body: formData
  }).then(response => {
    return response.text() 
  }).then(data => {
    if(data=="successful") { 
      document.getElementById('add-success-panel').classList.remove("w3-hide"); 
      setTimeout(function() {
        document.getElementById('add-success-panel').classList.add("w3-hide");
      }, 2000);
   } else {
      document.getElementById('add-error-panel').innerHTML=`${data}`
      document.getElementById('add-error-panel').classList.remove("w3-hide"); 
      setTimeout(function() {
        document.getElementById('add-error-panel').classList.add("w3-hide");
      }, 2000);
    }
  });
  getUsers();

}
async function updateUser(e) { 
  e.preventDefault();
  let formData = new FormData(document.getElementById("user-edit-form")); 
  fetch("/admin/user/edit", {
    method: "post",
    body: formData
  }).then(response => {
    return response.text() 
  }).then(data => {
    if(data=="successful") { 
      document.getElementById('update-success-panel').classList.remove("w3-hide"); 
      setTimeout(function() {
        document.getElementById('update-success-panel').classList.add("w3-hide");
      }, 2000);
   } else {
      document.getElementById('update-error-panel').innerHTML=`${data}`
      document.getElementById('update-error-panel').classList.remove("w3-hide"); 
      setTimeout(function() {
        document.getElementById('update-error-panel').classList.add("w3-hide");
      }, 2000);
    }
  });

  getUsers();
}
async function updateUserPassword(e) { 
  e.preventDefault();
  let formData = new FormData(document.getElementById("password-box-form")); 
  fetch("/admin/user/updatepassword", {
    method: "post",
    body: formData
  }).then(response => {
    return response.text() 
  }).then(data => {
    if(data=="successful") { 
      document.getElementById('password-success-panel').classList.remove("w3-hide"); 
      setTimeout(function() {
        document.getElementById('password-success-panel').classList.add("w3-hide");
      }, 2000);
   } else {
      document.getElementById('password-error-panel').innerHTML=`${data}`
      document.getElementById('password-error-panel').classList.remove("w3-hide"); 
      setTimeout(function() {
        document.getElementById('password-error-panel').classList.add("w3-hide");
      }, 2000);
    }
  });

  getUsers();
  
}


async function deleteUser(id) {
    const response = confirm("Are you sure you want to delete this user!");
    if (response == true) {
     await w3.getHttpObject(`/admin/user/delete/?id=${id}`); 
     let editForm = document.getElementById("user-edit-form"); 
     let addForm = document.getElementById("user-add-form"); 
     editForm.classList.add("w3-hide");
     addForm.classList.add("w3-hide");
     getUsers();
   }
   }

  async function hideuserpanel(){
    let addform = document.getElementById("user-add-form");
    addform.classList.add("w3-hide");
  }