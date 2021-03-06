
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

function showNewValueField(e, field){
    console.log(e.id);
    console.log(e.value);
    if(e.id === "bookColumnVal"){
        if(e.value != "invalid" && e.value != "category"){
            //show text field 
            document.getElementById("bookText").style.display = "inline";
            document.getElementById("bookOption").style.display = "none";
        }else if(e.value == "category"){
            //show select field 
            document.getElementById("bookText").style.display = "none";
            document.getElementById("bookOption").style.display = "inline";
        }
        else{
            //default value picked, hide bookText and bookOption fields
            document.getElementById("bookText").style.display = "none";
            document.getElementById("bookOption").style.display = "none";
        }
    }
    else if(e.id === "userColumnVal"){
        if(e.value != "invalid" && e.value != "userType"){
            //show text field
            document.getElementById("userText").style.display = "inline";
            document.getElementById("userOption").style.display = "none";
            
        }
        else if(e.value == "userType"){
            //show select field 
            document.getElementById("userText").style.display = "none";
            document.getElementById("userOption").style.display = "inline";
            
        }else{
            //default value picked, hide userText and userOption fields
            document.getElementById("userText").style.display = "none";
            document.getElementById("userOption").style.display = "none";
            
        }
        
    }
    else if(e.id === "editColumnVal"){
        if(e.value == "password"){
            document.getElementById("editText").style.display = "none";
            document.getElementById("editPassword").style.display = "inline";
            document.getElementById("editPassword2").style.display = "inline";
        }else{
            document.getElementById("editText").style.display = "inline";
            document.getElementById("editPassword").style.display = "none";
            document.getElementById("editPassword2").style.display = "none";
        }
    }
  
}

//for the admin update book page


//for the admin update user page
function showUpdateUserField(e){
    if(e.value != "invalid" && e.value != "userType"){
        document.getElementById("updateUserValue").style.display = "inline";
        document.getElementById("selectUserType").style.display = "none";
        document.getElementById("updateUserBtn").style.display = "inline";
    }
    else if(e.value != "invalid" && e.value == "userType"){
        document.getElementById("updateUserValue").style.display = "none";
        document.getElementById("selectUserType").style.display = "inline";
        document.getElementById("updateUserBtn").style.display = "inline";
    }else{
        document.getElementById("updateUserValue").style.display = "none";
        document.getElementById("selectUserType").style.display = "none";
        document.getElementById("updateUserBtn").style.display = "none";
    }
}
