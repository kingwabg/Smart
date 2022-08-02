{
    //console.log("hello");
    const tab1=document.querySelector("#tab1");
    const tab2=document.querySelector("#tab2");
    // const hanberger=document.querySelector('.hamburger');
    // const menu=document.querySelector('.menu');
    let tab_status=null;

    
        
    tab1.addEventListener('click',(e)=>{
        //console.log(e.target.value)
        if(tab_status!=e.target.value){
            tab_status=e.target.value;
            // console.log(tab_status)
            window.location.replace('allView.php');
        }else{

        }
        
        //console.log(tab_status)
    });
    tab2.addEventListener('click',(e)=>{
        //console.log(e.target.value)
        if(tab_status!=e.target.value){
            tab_status=e.target.value;
            window.location.replace('myPage.php');
        }else{

        }
        
        //console.log(tab_status)
    });
    $(function(){
        $('.hamburger').click(function(){
          $('.hamburger').toggleClass('active');
          $('.menu').toggleClass('open');
        }); 
      });
}