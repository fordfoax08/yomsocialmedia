
window.addEventListener('DOMContentLoaded', domLoad);
function domLoad(e){
  textArea.forEach(ta => {
    ta.value = "";
  })
}

/* TOGGLE SHOW/HIDE post menu **************** */
const moreBtn = document.querySelectorAll('.post-menu');
moreBtn.forEach(btn => {
  btn.addEventListener('click', moreDraw);
})
function moreDraw(e){
  const moreBtns = document.querySelectorAll('.more');
  if(!e.target.classList.contains('material-icons')){
    return;
  }

  
  /* if(document.querySelector('.more').classList.contains('open')){
    document.querySelector('.more').classList.remove('open');
  }else{
    document.querySelector('.more').classList.add('open');
  } */
  console.log(e.target);
}



/* TOGGLE SHOW/HIDE Comment area ************** */
const showCommentF = document.querySelectorAll('.comment-btn');
showCommentF.forEach(btn => {
  btn.addEventListener('click', showCommentField);
})
function showCommentField(e){
  const commentSec = e.target.parentNode.parentNode.nextElementSibling;
  const viewCom = commentSec.nextElementSibling;
  if(commentSec.classList.contains('open')){
    commentSec.classList.remove('open');
    viewCom.classList.remove('open');
  }else{
    commentSec.classList.add('open');
    viewCom.classList.add('open');
  }

  //console.log(commentSec);
}



/* TextArea for reply COmments ********/
const textArea = document.querySelectorAll('textarea');
textArea.forEach(text => {
  text.addEventListener('keyup',textarr);
})
function textarr(e){
  let strCounter = e.target.previousElementSibling;
  let postBtn = e.target.nextElementSibling.firstElementChild;
  let lengtStr = e.target.value.length;
  let scrlH = this.scrollHeight;
  if(scrlH <= 40){
    e.target.style.height = '40px';
  }else{
    e.target.style.height = scrlH +'px';
    if(e.target.value === ''){
      e.target.style.height = '40px';
    }
  }
  strCounter.innerText = e.target.value.length + '/255';
  if(lengtStr >= 255){
    strCounter.style.color = 'red';
    postBtn.disabled = true;
  }else{
    strCounter.style.color = 'black';
    postBtn.disabled = false;
  }
}


/* TOGGLE SHOW COMMENTS******* */
const showCommentS = document.querySelectorAll('.comments');
showCommentS.forEach(btn => {
  btn.addEventListener('click', showComments);
})
function showComments(e){
  if(!e.target.classList.contains('v-comments')) return;
  const reps = e.target.nextElementSibling;
  if(reps.classList.contains('open')){
    reps.classList.remove('open');
  }else{
    reps.classList.add('open');
  }
}


/* TOGGLE SUPPORT/LIKE Button************** */
const supportBtn = document.querySelectorAll('.support');
supportBtn.forEach(btn => {
  btn.addEventListener('click', btnLiked);
})
function btnLiked(e){
  /* if(e.target.classList.contains('true')){
    e.target.classList.remove('true');
  }else{
    e.target.classList.add('true');
  } */
  e.target.parentNode.submit();
}


/* TOGGLE SUBMIT BUTTON************ */
const commentBtn = document.querySelectorAll('.post-comment-btn');
commentBtn.forEach(btn => {
  btn.addEventListener('click', commentReply);
})
function commentReply(e){
  const text = e.target.parentNode.previousElementSibling.value; 
  //e.target.parentNode.parentNode.submit();
  if(isStringValid(text)){
    e.target.parentNode.parentNode.submit()
    //text = '';
    //console.log(text.length);
  }
}


/* DELETE POST REPLY *********************** */
const deleteRep = document.querySelectorAll('.delete-reply');
deleteRep.forEach(btn => {
  btn.addEventListener('click', deleteReply);
})
function deleteReply(e){
  if(confirm('Are you sure you wan\'t to delete reply?')){
    e.target.parentNode.submit();
    console.log(e.target);
  }
}



/* Err animation */
function errAnimate(){
  const errAnim  = document.querySelector('.err-container');
  errAnim.classList.add('open');
  setTimeout(() => {
    errAnim.classList.remove('open');
  },2000)

}












/* FOR VALIDATION PURPOSE */
function isStringValid(str){
  let regex = /<script[\s\S]*?>[\s\S]*?<\/script>/gi;
  if(str.length <= 0){
    return false;
  }
  if(str.length > 250){
    return false;
  }
  if(regex.test(str)){
    return false;
  }
  return true;
}

