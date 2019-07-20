var deleteUserRow = document.getElementsByClassName("deleteUser");
var deleteUserSelected = false;
//.addEventListener("click", onDeleteUserClick);
console.log(deleteUserRow);


for(var i = 0 ; i < deleteUserRow.length ; i++){
    deleteUserRow[i].addEventListener("click", onDeleteUserClick);
}

function onDeleteUserClick(e){
    if(!e.target.parentNode.classList.contains("deleteSelected") && !deleteUserSelected){
        e.target.parentNode.classList.add("deleteSelected");
        deleteUserSelected = true;
    }
    else if(e.target.parentNode.classList.contains("deleteSelected") && deleteUserSelected){
        //if de-selected delete user
        e.target.parentNode.classList.remove("deleteSelected");
        deleteUserSelected = false; 
    }
    
 //   e.target.parentNode.setAttribute("style", "background-color: red;");
}


// Admin Update Section

function selectCategory(e){
    if(e.value != "invalid"){
        document.getElementById("selectUpdateRow").style.display = "inline";
        document.getElementById("selectRowLabel").style.display = "inline";
    }else{
        document.getElementById("selectUpdateRow").style.display = "none";
        document.getElementById("selectRowLabel").style.display = "none";
    }
}

function showNewValueField(e){
    if(e.value != "invalid"){
        document.getElementById("updateValue").style.display = "inline";
        document.getElementById("updateUserBtn").style.display = "inline";
    }else{
        document.getElementById("updateValue").style.display = "none";
        document.getElementById("updateUserBtn").style.display = "none";
    }
}