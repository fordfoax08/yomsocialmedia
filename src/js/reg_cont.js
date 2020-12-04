
const submitBtn = document.querySelector('#submit-btn');
const inpt = document.querySelector('#upload-img');
const addHobby = document.querySelector('#addHobby');
const addSkill = document.querySelector('#addSkills');


runFunctions();

function runFunctions(){
  submitBtn.addEventListener('click', uploadData);
  addHobby.addEventListener('click', addHb);
  addSkill.addEventListener('click', addSk);

}


function uploadData(e){
  const img = document.querySelector('#upload-img');
  const allText = document.querySelectorAll('input[type="text"]');
  const textA = document.querySelector('#user_bio');
  const email = document.querySelector('input[type="email"]');
  const website = document.querySelector('input[name="user_website"]');
  let errCount = 0;
  //The purpose of errCount is to record number of error or undefined input and return later when > 0
//Check if Image is selected
  if(img.files.length === 0){
    errCount++;
    alert('Select Image');
  }
  //Check every input text if empty if true add errCount
  allText.forEach(item => {
    if(item.value.length <= 0 && item.name !== 'user_website'){
      item.style.border = '2px solid red';
      errCount++;
    }else{
      if(isStringValid(item.value)){
        item.style.border = '1px solid rgb(176, 241, 78)';
      }else{
        item.style.border = '2px solid red';
        errCount++;
      }
    }
  })
//Check if Email value if empty add counter
  if(email.value.length <= 0){
    email.style.border = '2px solid red';
    errCount++;
  }else{
    if(isEmailValid(email.value)){
      email.style.border = '2px solid rgb(176, 241, 78)';
    }else{
      email.style.border = '2px solid red';
      errCount++;
    }
  }
//Check if website contains
  if(!isStringValid(website.value)){
    website.style.border = '2px solid red';
    errCount++;
  }else{
    website.style.border = '2px solid rgb(176, 241, 78)';
  }
//Check if textarea is empty add errCounter if true
  if(textA.value.length <= 0){
    textA.style.border = '2px solid red';
    errCount++;
  }else{
    textA.style.border = '2px solid rgb(176, 241, 78)';
  }
//Check if there is an error and do not submit if error exist.
  if(!errCount > 0){
    e.target.parentNode.parentNode.submit();
  }
    //console.log(errCount);
}

inpt.onchange = function(e){
  const imgTempDir = document.querySelector('.profile-img');
  const imageP = document.querySelector('#profile-image');
  if(e.target.files.length > 0){
    let src = URL.createObjectURL(e.target.files[0]);
    imageP.src = src;
  }
}
function addHb(e){
  let hobbiesContainer = document.querySelector('.user-hobbies');
  let plcBefor = document.querySelector('.add-hobbies');
  const inpt = document.querySelectorAll('.usrhb') ?? [];
  let inptCnt = inpt.length;
  if(inptCnt < 3){
    let newIpt = document.createElement('input');
    newIpt.type = 'text';
    newIpt.name = `user_hobbies[${inptCnt}]`;
    newIpt.id = 'user_hobbies';
    newIpt.placeholder = 'Hobby';
    newIpt.className = 'usrhb';
    hobbiesContainer.insertBefore(newIpt, plcBefor);
    setTimeout(proc => {
      document.querySelectorAll('.usrhb').forEach(item => {
        if(!item.classList.contains('anim')){
          item.classList.add('anim');
        }
      })
    }, 50)
  }
}

function addSk(e){
  let hobbiesContainer = document.querySelector('.user-skills');
  let plcBefor = document.querySelector('.add-skills');
  const inpt = document.querySelectorAll('.usrsk') ?? [];
  let inptCnt = inpt.length;
  if(inptCnt < 3){
    let newIpt = document.createElement('input');
    newIpt.type = 'text';
    newIpt.name = `user_skills[${inptCnt}]`;
    newIpt.placeholder = 'Skill';
    newIpt.className = 'usrsk';
    hobbiesContainer.insertBefore(newIpt, plcBefor);
    setTimeout(proc => {
      document.querySelectorAll('.usrsk').forEach(item => {
        if(!item.classList.contains('anim')){
          item.classList.add('anim');
        }
      })
    }, 50)
    
  }
}




/* REGEX PART and OTHE INPUT FILTER */
function isEmailValid(email){
  let regex =  /^[A-Za-z0-9_.]{3,30}@[A-Za-z]{2,20}.[A-Za-z]{2,20}$/i;
  if(!regex.test(email)){
    return false;
  }
  return true;
}

function isStringValid(str){
  //let regex = /^[<>/]$/i;
  let regex = /<script[\s\S]*?>[\s\S]*?<\/script>/gi;
  if(str.length > 200){
    return false;
  }
  if(regex.test(str)){
    return false;
  }
  return true;
}