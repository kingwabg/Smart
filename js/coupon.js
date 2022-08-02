{
    /*URL正規表現 */
    console.log(document.referrer);
    let referrer=new RegExp('^(https|http):\/\/.*\/use_coupon.php');
    const images=document.querySelectorAll(".simage");//OK
    const clear=document.querySelector("#clear");

    /*PHPより変数受け取る*/
    console.log(count)//coupon回数
    console.log(number);//my.coupon_id

    /**変数宣言 */
    let data=[];
    const index=10;
    let flag=false;
    const StorageName="stamp";

    clear.addEventListener("click",()=>{
        localStorage.clear();
        location.reload()
    })
    
    /*sessionStorage:not exsist=0、あればその数字*/
    /*いちいち画像貼りなおすのはめんどい
    * リロードしたら元に戻る➞localStorage☑
    * myPageから来た時に前の結果が保存される☑
    * "クーポンごとに作らなきゃ"
    * →phpからの変数受け渡しで管理する
    */

    //localStorage:not exsist=null;
    // if(!localStorage.getItem("index")){
    //     localStorage.setItem("index",10-count);
    // }
    //次indexはOK、でもindex以外元に戻る
    stamp();
    console.log(JSON.parse(localStorage.getItem(StorageName)))
    
        // localStorage.clear();
        /**1回目　OK */
        if(!localStorage.getItem(StorageName)){
            data.push({id:number,count:index-count});
            console.log(data)
            localStorage.setItem(StorageName,JSON.stringify(data));
            console.log(JSON.parse(localStorage.getItem(StorageName)))
            
        }else{
            /*2回目以降*/
            console.log(JSON.parse(localStorage.getItem(StorageName)))
            data=JSON.parse(localStorage.getItem(StorageName))
            //coupon検索_一致 OK
            for(let i=0;i<data.length;i++){//OK
                if(number==data[i].id){
                    data[i].count=index-count;
                    flag=true;
                }
            }
            //不一致 OK
            if(!flag){
                data.push({id:number,count:index-count});
                console.log(data)
            }
            
            localStorage.setItem(StorageName,JSON.stringify(data));
            stamp();
            console.log(JSON.parse(localStorage.getItem(StorageName)))
            // localStorage.clear();
        // console.log(images)
        // let index=localStorage.getItem("index");
        // console.log(index)
        // localStorage.removeItem("index");
        // for(let i=0;i<index;i++){
        //     images[i].src="./image/stamp.png";
        // }
        // if(index<images.length-1){
        //     images[index].src="./image/stamp.png";
        //     // index++;
        //     localStorage.setItem("index",10-count);
        //     console.log(index)
        // }else{//OutOfBurnsもOK
        //     localStorage.removeItem("index");
        //     localStorage.clear();
        // }
    deleteStorage()
    // }
    function deleteStorage(){
        /**localStorage削除 */
        for(let i=0;i<data.length;i++){
            if(data[i].count>=10){
                data.splice(i,1);
            }
        }
        localStorage.setItem(StorageName,JSON.stringify(data));
        console.log(JSON.parse(localStorage.getItem(StorageName)))
    }
    }
    function stamp(){
        let num=0;
        let stamp=JSON.parse(localStorage.getItem(StorageName));
        
        if(stamp){
            // console.log(stamp.length)
            for(let i=0;i<stamp.length;i++){
                if(stamp[i].id==number){
                    num=stamp[i].count;
                    break;
                }
            }
            console.log(num)
            for(let i=0;i<num;i++){
                images[i].src="./images/stamp.png";
            }
            // location.reload();
        }
    }
}