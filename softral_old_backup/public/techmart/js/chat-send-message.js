$(document).ready(function(){
    
    $("textarea[name=msg]").keypress(function(e){
        if (e.keyCode == 13 && !e.shiftKey)
        {        
            
            e.preventDefault();
            //now call the code to submit your form
            //alert("just enter was pressed");
            $('#msg_form').trigger('submit');
            return;
        }

        if (e.keyCode == 13 && e.shiftKey)
        {       
        //this is the shift+enter right now it does go to a new line
        //alert("shift+enter was pressed");        
        }    
    });



    //scTop(); // Comment on 13/09/2016
    
    
    $("#msg_form").on("submit",function(){
      
        t=$(this);
        val=$(this).find("input[type=text]").val();
    
        //var msg = $(t).find("input[name=msg]").val();
        var msg = $(t).find("textarea[name=msg]").val();
        msg = msg.replace(/\n\r?/g, '<br />');
        
        var definition = {
            "smile":{
                "title":"Smile",
                "codes":[":)",":=)",":-)"]
            },
            "sad-smile":{
                "title":"Sad Smile",
                "codes":[":(",":=(",":-("]
            },
            "big-smile":{
                "title":"Big Smile",
                "codes":[":D",":=D",":-D",":d",":=d",":-d"]
            },
            "cool":{
                "title":"Cool",
                "codes":["8)","8=)","8-)","B)","B=)","B-)","(cool)"]
            },
            "wink":{
                "title":"Wink",
                "codes":[":o",":=o",":-o",":O",":=O",":-O"]
            },
            "crying":{
                "title":"Crying",
                "codes":[";(",";-(",";=("]
            },
            "sweating":{
                "title":"Sweating",
                "codes":["(sweat)","(:|"]
            },
            "speechless":{
                "title":"Speechless",
                "codes":[":|",":=|",":-|"]
            },
            "kiss":{
                "title":"Kiss",
                "codes":[":*",":=*",":-*"]
            },
            "tongue-out":{
                "title":"Tongue Out",
                "codes":[":P",":=P",":-P",":p",":=p",":-p"]
            },
            "blush":{
                "title":"Blush",
                "codes":["(blush)",":$",":-$",":=$",":\">"]
            },
            "wondering":{
                "title":"Wondering",
                "codes":[":^)"]
            },
            "sleepy":{
                "title":"Sleepy",
                "codes":["|-)","I-)","I=)","(snooze)"]
            },
            "dull":{
                "title":"Dull",
                "codes":["|(","|-(","|=("]
            },
            "in-love":{
                "title":"In love",
                "codes":["(inlove)"]
            },
            "evil-grin":{
                "title":"Evil grin",
                "codes":["]:)",">:)","(grin)"]
            },
            "talking":{
                "title":"Talking",
                "codes":["(talk)"]
            },
            "yawn":{
                "title":"Yawn",
                "codes":["(yawn)","|-()"]
            },
            "puke":{
                "title":"Puke",
                "codes":["(puke)",":&",":-&",":=&"]
            },
            "doh!":{
                "title":"Doh!",
                "codes":["(doh)"]
            },
            "angry":{
                "title":"Angry",
                "codes":[":@",":-@",":=@","x(","x-(","x=(","X(","X-(","X=("]
            },
            "it-wasnt-me":{
                "title":"It wasn't me",
                "codes":["(wasntme)"]
            },
            "party":{
                "title":"Party!!!",
                "codes":["(party)"]
            },
            "worried":{
                "title":"Worried",
                "codes":[":S",":-S",":=S",":s",":-s",":=s"]
            },
            "mmm":{
                "title":"Mmm...",
                "codes":["(mm)"]
            },
            "nerd":{
                "title":"Nerd",
                "codes":["8-|","B-|","8|","B|","8=|","B=|","(nerd)"]
            },
            "lips-sealed":{
                "title":"Lips Sealed",
                "codes":[":x",":-x",":X",":-X",":#",":-#",":=x",":=X",":=#"]
            },
            "hi":{
                "title":"Hi",
                "codes":["(hi)"]
            },
            "call":{
                "title":"Call",
                "codes":["(call)"]
            },
            "devil":{
                "title":"Devil",
                "codes":["(devil)"]
            },
            "angel":{
                "title":"Angel",
                "codes":["(angel)"]
            },
            "envy":{
                "title":"Envy",
                "codes":["(envy)"]
            },
            "wait":{
                "title":"Wait",
                "codes":["(wait)"]
            },
            "bear":{
                "title":"Bear",
                "codes":["(bear)","(hug)"]
            },
            "make-up":{
                "title":"Make-up",
                "codes":["(makeup)","(kate)"]
            },
            "covered-laugh":{
                "title":"Covered Laugh",
                "codes":["(giggle)","(chuckle)"]
            },
            "clapping-hands":{
                "title":"Clapping Hands",
                "codes":["(clap)"]
            },
            "thinking":{
                "title":"Thinking",
                "codes":["(think)",":?",":-?",":=?"]
            },
            "bow":{
                "title":"Bow",
                "codes":["(bow)"]
            },
            "rofl":{
                "title":"Rolling on the floor laughing",
                "codes":["(rofl)"]
            },
            "whew":{
                "title":"Whew",
                "codes":["(whew)"]
            },
            "happy":{
                "title":"Happy",
                "codes":["(happy)"]
            },
            "smirking":{
                "title":"Smirking",
                "codes":["(smirk)"]
            },
            "nodding":{
                "title":"Nodding",
                "codes":["(nod)"]
            },
            "shaking":{
                "title":"Shaking",
                "codes":["(shake)"]
            },
            "punch":{
                "title":"Punch",
                "codes":["(punch)"]
            },
            "emo":{
                "title":"Emo",
                "codes":["(emo)"]
            },
            "yes":{
                "title":"Yes",
                "codes":["(y)","(Y)","(ok)"]
            },
            "no":{
                "title":"No",
                "codes":["(n)","(N)"]
            },
            "handshake":{
                "title":"Shaking Hands",
                "codes":["(handshake)"]
            },
            "skype":{
                "title":"Skype",
                "codes":["(skype)","(ss)"]
            },
            "heart":{
                "title":"Heart",
                "codes":["(h)","<3","(H)","(l)","(L)"]
            },
            "broken-heart":{
                "title":"Broken heart",
                "codes":["(u)","(U)"]
            },
            "mail":{
                "title":"Mail",
                "codes":["(e)","(m)"]
            },
            "flower":{
                "title":"Flower",
                "codes":["(f)","(F)"]
            },
            "rain":{
                "title":"Rain",
                "codes":["(rain)","(london)","(st)"]
            },
            "sun":{
                "title":"Sun",
                "codes":["(sun)"]
            },
            "time":{
                "title":"Time",
                "codes":["(o)","(O)","(time)"]
            },
            "music":{
                "title":"Music",
                "codes":["(music)"]
            },
            "movie":{
                "title":"Movie",
                "codes":["(~)","(film)","(movie)"]
            },
            "phone":{
                "title":"Phone",
                "codes":["(mp)","(ph)"]
            },
            "coffee":{
                "title":"Coffee",
                "codes":["(coffee)"]
            },
            "pizza":{
                "title":"Pizza",
                "codes":["(pizza)","(pi)"]
            },
            "cash":{
                "title":"Cash",
                "codes":["(cash)","(mo)","($)"]
            },
            "muscle":{
                "title":"Muscle",
                "codes":["(muscle)","(flex)"]
            },
            "cake":{
                "title":"Cake",
                "codes":["(^)","(cake)"]
            },
            "beer":{
                "title":"Beer",
                "codes":["(beer)"]
            },
            "drink":{
                "title":"Drink",
                "codes":["(d)","(D)"]
            },
            "dance":{
                "title":"Dance",
                "codes":["(dance)","\o/","\:D/","\:d/"]
            },
            "ninja":{
                "title":"Ninja",
                "codes":["(ninja)"]
            },
            "star":{
                "title":"Star",
                "codes":["(*)"]
            },
            "mooning":{
                "title":"Mooning",
                "codes":["(mooning)"]
            },
            "finger":{
                "title":"Finger",
                "codes":["(finger)"]
            },
            "bandit":{
                "title":"Bandit",
                "codes":["(bandit)"]
            },
            "drunk":{
                "title":"Drunk",
                "codes":["(drunk)"]
            },
            "smoking":{
                "title":"Smoking",
                "codes":["(smoking)","(smoke)","(ci)"]
            },
            "toivo":{
                "title":"Toivo",
                "codes":["(toivo)"]
            },
            "rock":{
                "title":"Rock",
                "codes":["(rock)"]
            },
            "headbang":{
                "title":"Headbang",
                "codes":["(headbang)","(banghead)"]
            },
            "bug":{
                "title":"Bug",
                "codes":["(bug)"]
            },
            "fubar":{
                "title":"Fubar",
                "codes":["(fubar)"]
            },
            "poolparty":{
                "title":"Poolparty",
                "codes":["(poolparty)"]
            },
            "swearing":{
                "title":"Swearing",
                "codes":["(swear)"]
            },
            "tmi":{
                "title":"TMI",
                "codes":["(tmi)"]
            },
            "heidy":{
                "title":"Heidy",
                "codes":["(heidy)"]
            },
            "myspace":{
                "title":"MySpace",
                "codes":["(MySpace)"]
            },
            "malthe":{
                "title":"Malthe",
                "codes":["(malthe)"]
            },
            "tauri":{
                "title":"Tauri",
                "codes":["(tauri)"]
            },
            "priidu":{
                "title":"Priidu",
                "codes":["(priidu)"]
            }
        };
        $.emoticons.define(definition);
       
        var textWithEmoticons = $.emoticons.replace(msg);
        msg = textWithEmoticons;
        
    
        if(val!=""){
           
            t.after("<span id='send_status'>Sending.....</span>");
                
            //alert("We will fix this sending message");
            
            $.post(base_url + "chat-send.php",{//$.post("http://www.netnoor.com/chat-send.php",
                Question: $(t).find("input[name=Question]").val(),
                sendto: $(t).find("input[name=sendto]").val(),
                //groupid: $(t).find("input[name=groupid]").val(),
                msg: msg,//msg: $(t).find("input[name=msg]").val()
                edit: $(t).find("input[name=edit-box]").val()
            },function(){
                
                
                    
                /**
                     * Important Because It laods two messaages....
                     * 
                     * Commented on 30/08/2016..
                     */
                    
                //                    var new_mess = '<div class="col-xs-10 col-sm-10 col-md-12">'+
                //                        '<div class="msg me" title="2016-08-30 17:13:42">'+
                //                        '<span style="word-wrap:break-word" class="msgc">'+ msg + '</span>'+
                //                        '</div>'+
                //                        '<input type="hidden" class="mess_id" value="945">'+
                //                        '<span class="short_time">03:43 AM</span></div>';
                //                    
                //                    $(".msgs").append(new_mess);
                //                    
                //                    if(localStorage['lpid']!=$(".msgs .msg:last").attr("title")){
                //                        scTop();
                //                    }
                    

                var last_message = $(".msgs .msg:last").attr("title");
                if(last_message == null){
                    //alert("aaaaaaaa");
                    load_all_messasges();
                }
                //load_new_messasges();
                /**
                     * Important Because It laods two messaages....
                     * 
                     * End Here
                     */
                    
                    
                    
                    
                    
                $("#send_status").remove();
                //t[0].reset();
                //$(t).find("input[name=msg]").val("");
                $(t).find("textarea[name=msg]").val("")
            });
        }else{
            alert("hhh");
        }
        
        return false;
    });
});
    
$(".attachment").on("click", function(){
    $( "#fileupload" ).trigger( "click" );
})
    
    
    
