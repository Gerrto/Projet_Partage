import {addComment} from './gestionaireAjax.js';


document.querySelector("#form input").onclick=()=>{
    console.log("Robynnn Frauhn ");
    if( document.querySelector("#form #description").value.length > 4 ){
        let oeuvre,description,login;
        oeuvre = document.querySelector("[data-oeuvre]").dataset.oeuvre
        description = document.querySelector("[data-description]").value
        login = document.querySelector("[data-login]").dataset.login
        addComment(oeuvre,description,login);
    } 
};
