const postBtn = document.querySelector('#post-btn');
const moreBtn = document.querySelectorAll('.post-menu');
const hobbiesBtn = document.querySelector('.u-hobbies');
const skillsBtn = document.querySelector('.u-skills');
const texta = document.querySelector('#comment');
const messagePop = document.querySelector('.message');
const deleteComment = document.querySelectorAll('.delete-comment');
const updateBtn = document.querySelector('#update-btn');
const delImgBtn = document.querySelector('#del-img-btn');
const closeUpdatePanel = document.querySelector('.container3');

postBtn.addEventListener('click', submitComment);
moreBtn.forEach(btn => {
  btn.addEventListener('click', moreDraw);
})
hobbiesBtn.addEventListener('click', showHobbies);
skillsBtn.addEventListener('click', showSkills);
texta.addEventListener('keyup', textComment);
deleteComment.forEach(btn => {
  btn.addEventListener('click', commentDelete);
})
updateBtn.addEventListener('click', updatePost);
delImgBtn.addEventListener('click', deleteImage);
closeUpdatePanel.addEventListener('click', closeUpdateWindow);



function submitComment(e){
  let ctitle = document.querySelector('input[name="comment_title"]');
  let cbody = document.querySelector('#comment');
  let errCount = 0;
  if(!isStringValid(ctitle.value)){
    errCount++;
  }
  if(!isStringValid(cbody.value)){
    errCount++;
  }
  if(errCount <= 0){
    e.target.parentNode.parentNode.submit();
  }
}

function moreDraw(e){
  if(!e.target.classList.contains('material-icons')){
    return;
  }
  moreBtn.forEach(btn => {
    if(btn.parentNode.classList.contains('more')){
      if(btn.parentNode !== e.target.parentNode.nextElementSibling){
        if(btn.parentNode.classList.contains('open')){
          btn.parentNode.classList.remove('open')
        }
      }

    }
  })

  if(e.target.parentNode.nextElementSibling.classList.contains('open')){
    e.target.parentNode.nextElementSibling.classList.remove('open');
  }else{
    e.target.parentNode.nextElementSibling.classList.add('open');
  }
  //console.log(e.target.parentNode.nextElementSibling);
}

function showHobbies(e){
  if(!e.target.classList.contains('u-hobbies')) return;
  let hb = e.target.nextElementSibling;
  let ht = e.target.nextElementSibling.scrollHeight;
  if(hb.classList.contains('close')){
    hb.classList.remove('close');
    hb.style.height = ht + 'px';
  }else{
    hb.classList.add('close');
    hb.style.height = '0';
    document.querySelector('.u-skills-1').classList.add('close');
  }
  //console.log(e.target.nextElementSibling.scrollHeight);
}

function showSkills(e){
  if(!e.target.classList.contains('u-skills')) return;
  let hb = e.target.nextElementSibling;
  let ht = e.target.nextElementSibling.scrollHeight;
  if(hb.classList.contains('close')){
    hb.classList.remove('close');
    hb.style.height = ht + 'px';
  }else{
    hb.classList.add('close');
    hb.style.height = '0';
  }
  //console.log(e.target.nextElementSibling.scrollHeight);
}

function textComment(e){
  let scrlH = texta.scrollHeight < 70 ? 70 : texta.scrollHeight ;
  if(scrlH <= 40){
    texta.style.height = '70px';
  }else{
    texta.style.height = scrlH +'px';
    if(texta.value === ''){
      texta.style.height = '70px';
    }
  }
  /* console.log(e.target.value);
  console.log(texta.value); 
  */
}

function msgPop(){
  if(messagePop.classList.contains('close')){
    messagePop.classList.remove('close');
  }
  setTimeout(() => {
    messagePop.classList.add('close');
  },3000)
 /*  messagePop.classList.add('close'); 
 onload="<?php echo isset($_SESSION['err']) ? 'msgPop()': '';?>"
 */
}
function commentDelete(e){
  if(confirm('Are you sure you want to delete this post?')){
    e.target.parentNode.submit();
  }
}
function updatePost(e){
  let updateTitle = document.querySelector('#update_title');
  let updateData = document.querySelector('#upload-comment');
  if(!isStringValid(updateTitle.value)){
    return;
  }
  if(!isStringValid(updateData.value)){
    return;
  }
  e.target.parentNode.parentNode.submit();
}
function deleteImage(e){
  if(confirm('Remove Image?')){
    document.querySelector('input[name="comment_img_delete"]').value = 1;
    e.target.parentNode.classList.add('close');
    setTimeout(()=>{
      e.target.parentNode.style.display = 'none';
    },500)
  }
}
function closeUpdateWindow(e){
  if(!e.target.classList.contains('container3')){
    if(!e.target.classList.contains('close-update')){
      return;
    }
  }
  closeUpdateWin();
}
function closeUpdateWin(){
  document.querySelector('.update-container').classList.add('close');
  setTimeout(()=>{
    document.querySelector('.container3').classList.add('close');
    window.history.back();
  },600)
}







function isStringValid(str){
  //let regex = /^[<>/]$/i;
  let regex = /<script[\s\S]*?>[\s\S]*?<\/script>/gi;
  if(str.length <= 0){
    return false;
  }
  if(regex.test(str)){
    return false;
  }
  return true;
}