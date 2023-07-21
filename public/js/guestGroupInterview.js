
$(document).ready(function () {
  var userEmails = '';
  class AddEmails {
      constructor() {
        this.emailInput = document.getElementById("email");
        this.emailListContainer = document.querySelector("div#emailsList ul");
        this.errors = document.getElementById("errors");
      }
      // some regex copied from internet
      isValidEmail(val) {
        let re =
          /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(val);
      }
  
      isAlreadyExist(val){
          let existEmail = false;
          document.querySelectorAll("div#emailsList ul li").forEach((ele) => {
              if(ele.innerHTML == val){
                $('#group-email-error').html('Email already added.');
                  // console.log(ele.innerHTML,"ele.innerHTML");
                  existEmail = true;
                  return;
              }
              // emails.push(ele.innerHTML.replace(/ /g, ""));
            });
          if(existEmail){
              return true;
          }
      }
  
      getEmails() {
        var emails = [];
        document.querySelectorAll("div#emailsList ul li").forEach((ele) => {
          emails.push(ele.innerHTML.replace(/ /g, ""));
        });
      //   console.log(JSON.stringify(emails));
        return JSON.stringify(emails);
      }
  
      init() {
          // console.log(this.emailInput);
          if(this.emailInput == null){
              return;
          }
        this.emailInput.onkeyup = (e) => {
          $('#group-email-error').html('');
          if (
            e.keyCode == 0 ||
            e.keyCode == 32 ||
            e.keyCode == 13 ||
            e.keyCode == 188
          ) {
            let val = e.target.value
              .trim()
              .replace(/ /g, "")
              .replace(/,/g, "");
  
            if (this.isValidEmail(val)) {
              if(this.isAlreadyExist(val)){
                  // console.log("object");
                  // this.emailInput.classList.remove("border-secondary");
                  // this.emailInput.classList.add("border-danger");
                  return;
              }
              // console.log(val);
  
              let li = document.createElement("li");
              li.title = "Press to remove the email";
              li.innerHTML = val;
              this.emailListContainer.appendChild(li);
              this.emailInput.value = "";
  
              // removing email from the list
              li.addEventListener("click", function (e) {
                e.target.parentNode.removeChild(e.target);
              });
              userEmails = this.getEmails();
              return;
            }
          }
        };
      }
    }
  
    var addEmails = new AddEmails();
    addEmails.init();
  
    var demoEmails = "youare@awesome.com";
  
    if(this.emailInput != null){
        var myVar = setInterval(myTimer, 200);
    }
  
    var i = 0;
  
    function myTimer() {
      if (i == demoEmails.length) {
        myStopFunction();
        return;
      }
      i++;
    }
  
    function myStopFunction() {
      clearInterval(myVar);
      document
        .getElementById("email")
        .dispatchEvent(new KeyboardEvent("keyup", { key: "enter" }));
    }
  
    $('#submitMultipleUsers').click(function(e){
      e.preventDefault();
      if(userEmails == ""){
        $.toast({
          heading: 'Warning',
          text: 'Please enter any email. ;)',
          showHideTransition: 'plain',
          position: {
              left: 50,
              top: 30
          },
          icon: 'warning'
        })
        return false;
      }
      // console.log(userEmails,"userEmails");
      let emailCollection = userEmails;
      let blockId = $('#store_block_id').val();
      // console.log(blockId,"block_id");
  
      $.ajax({
          type: "post",
          url: "/admin/multi-users-interview",
          data: {
              emails: emailCollection,
              blockId: blockId,
          },
          dataType: "json",
          success: function (res) {
            if(res.code == 422){
              $('#group-email-error').html('At least one email is required');
            }
            if(res.code == 200){
              Swal.fire({
                position: 'bottom',
                icon: 'success',
                title: 'Emails sent Successfully',
                timer: 1500
              }).then(function () {
                location.reload();
              });
            }
          }
      });
    });
  
    
  
    $('.back-btn-group-interviews').click(function (e) { 
      e.preventDefault();
      window.history.back();
    });
  
    var addUserEmails = '';
    class AddEmails2 {
      constructor() {
        this.emailInput = document.getElementById("addEmail");
        this.emailListContainer = document.querySelector("div#addEmailsList ul");
        this.errors = document.getElementById("errors");
      }
      // some regex copied from internet
      isValidEmail(val) {
        let re =
          /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(val);
      }
  
      isAlreadyExist(val){
          let existEmail = false;
          document.querySelectorAll("div#addEmailsList ul li").forEach((ele) => {
              if(ele.innerHTML == val){
                $('#email-error').html('Email already added.');
                  // console.log(ele.innerHTML,"ele.innerHTML");
                  existEmail = true;
                  return;
              }
              // emails.push(ele.innerHTML.replace(/ /g, ""));
            });
          if(existEmail){
              return true;
          }
      }
  
      getEmails() {
        var addEmails = [];
        document.querySelectorAll("div#addEmailsList ul li").forEach((ele) => {
          addEmails.push(ele.innerHTML.replace(/ /g, ""));
        });
      //   console.log(JSON.stringify(emails));
        return JSON.stringify(addEmails);
      }
  
      init() {
          // console.log(this.emailInput);
          if(this.emailInput == null){
              return;
          }
        this.emailInput.onkeyup = (e) => {
          $('#email-error').html('');
          if (
            e.keyCode == 0 ||
            e.keyCode == 32 ||
            e.keyCode == 13 ||
            e.keyCode == 188
          ) {
            let val = e.target.value
              .trim()
              .replace(/ /g, "")
              .replace(/,/g, "");
  
            if (this.isValidEmail(val)) {
              if(this.isAlreadyExist(val)){
                  // console.log("object");
                  // this.emailInput.classList.remove("border-secondary");
                  // this.emailInput.classList.add("border-danger");
                  return;
              }
              // console.log(val);
  
              let li = document.createElement("li");
              li.title = "Press to remove the email";
              li.innerHTML = val;
              this.emailListContainer.appendChild(li);
              this.emailInput.value = "";
  
              // removing email from the list
              li.addEventListener("click", function (e) {
                e.target.parentNode.removeChild(e.target);
              });
              addUserEmails = this.getEmails();
              return;
            }
          }
        };
      }
    }
  
    var addNewEmails = new AddEmails2();
    addNewEmails.init();
  
    var demoEmails = "youare@awesome.com";
  
    if(this.emailInput != null){
        var myVar = setInterval(myTimer, 200);
    }
  
    var k = 0;
  
    function myTimer() {
      if (k == demoEmails.length) {
        myStopFunction();
        return;
      }
      k++;
    }
  
    function myStopFunction() {
      clearInterval(myVar);
      document
        .getElementById("addEmail")
        .dispatchEvent(new KeyboardEvent("keyup", { key: "enter" }));
    }
  
  
    $('#addSubmitMultipleUsers').click(function(e){
      e.preventDefault();
      if(addUserEmails == ""){
        $.toast({
          heading: 'Warning',
          text: 'Please enter any email. ;)',
          showHideTransition: 'plain',
          position: {
              left: 50,
              top: 30
          },
          icon: 'warning'
        })
        return false;
      }
      let id = $(this).data('id');
      let emailCollection = addUserEmails;
      $.ajax({
          type: "post",
          url: "/admin/add-group-interview-candidate",
          data: {
              id:id,
              emails: emailCollection,
              // blockId: blockId,
          },
          dataType: "json",
          success: function (res) { 
            if(res.code == 422){
              $('#email-error').html('At least one email is required');
            }
            if(res.code == 200){
              Swal.fire({
                position: 'bottom',
                icon: 'success',
                title: 'Emails sent Successfully',
                timer: 1500
              }).then(function () {
                location.reload();
              });
            }
          }
      });
    });

    $('#resendEmailBtn').click(function(e){
      e.preventDefault();
      let groupInterviewId = $(this).data('id');
      let userIndex = $(this).data('index');
      console.log(groupInterviewId, userIndex);
      $.ajax({
        type: "post",
        url: "/admin/resend-interview-email",
        data: {
          groupInterviewId:groupInterviewId,
          userIndex:userIndex,
        },
        dataType: "json",
        success: function (response) {
          
        }
      });
    });
});



