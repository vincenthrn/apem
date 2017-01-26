$(document).ready(function(){
    var width = window.innerWidth;
    var height = window.innerHeight;

    var controller = new ScrollMagic.Controller();

// SCENE1
    var tween = TweenMax.to(".scene1__msg", 0, {marginTop:"10vh"})
    var tween2 = TweenMax.to(".scene1__drop", 0, {display:"block"})
    var tween3 = TweenMax.to(".scene1__drop p", 0, {display: "block"})
    var tween4 = TweenMax.to(".scene1__msg2", 0, {display: "block"})
    var tween5 = TweenMax.to(".scene1", 2, {left: "-=200vh"})

    var scene = new ScrollMagic.Scene({offset: height/4})
        .setTween(tween)
        .addIncators()

    var scene2 = new ScrollMagic.Scene({offset: height/4})
        .setTween(tween2)
    // .addIncators()

    var scene3 = new ScrollMagic.Scene({offset: height/2})
        .setTween(tween3)
    // .addIncators()

    var scene4 = new ScrollMagic.Scene({offset: 3*height/4})
        .setTween(tween4)
    // .addIncators()

    var scene5 = new ScrollMagic.Scene({offset: height})
        .setTween(tween5)
    // .addIncators()

// SCENE2
    var s2Tween = TweenMax.to(".scene2", 2, {display:"block", left:"-=200vh"})
    var s2Tween2 = TweenMax.to(".scene2 img", 0, {display:"block", delay: 2})
    var s2Tween3 = TweenMax.to(".scene2 p", 0, {display:"block", delay: 2})
    var s2Tween4 = TweenMax.to(".scene2", 2, {transform: "scale(2)"})
    var s2Tween5 = TweenMax.to(".scene2 p", 2, {fontSize: "25px"})
    var s2Tween6 = TweenMax.to(".scene2", 0.5, {autoAlpha: 0})

    var scene6 = new ScrollMagic.Scene({offset: height})
        .setTween(s2Tween)
    // .addIncators()

    var scene7 = new ScrollMagic.Scene({offset: height})
        .setTween(s2Tween2)
    // .addIncators()


    var scene8 = new ScrollMagic.Scene({offset: height})
        .setTween(s2Tween3)
    // .addIncators()

    var scene9 = new ScrollMagic.Scene({offset: 5*height/4})
        .setTween(s2Tween4)
    // .addIncators()

    var scene10 = new ScrollMagic.Scene({offset: 5*height/4})
        .setTween(s2Tween5)
    // .addIncators()

    var scene11 = new ScrollMagic.Scene({offset: 6*height/4})
        .setTween(s2Tween6)
    // .addIncators()

// SCENE3
    var s3Tween = TweenMax.to(".scene3", 0, {display: "block"})
    var s3Tween2 = new TimelineMax()
        .add(TweenMax.to(".scene3__peoplePart1 img:last-child, .scene3__peoplePart2 img:first-child", 1, {opacity: 1}))
        .add(TweenMax.to(".scene3__peoplePart1 img:first-child, .scene3__peoplePart2 img:last-child", 1, {opacity: 1}))

    var s3Tween3 = new TimelineMax()
        .add(TweenMax.to(".scene3__peoplePart2", 1, {marginLeft: "+=100px"}))
        .add(TweenMax.to(".scene3__peopleChild", 1, {opacity: "1"}))

    var s3Tween4 = TweenMax.to(".scene3", 0, {autoAlpha: 0})

    var scene12 = new ScrollMagic.Scene({offset: 6*height/4})
        .setTween(s3Tween)
    // .addIncators()

    var scene13 = new ScrollMagic.Scene({offset: 6*height/4})
        .setTween(s3Tween2)
    // .addIncators()

    var scene14 = new ScrollMagic.Scene({offset: 6*height/4, duration: height/4})
        .setTween(s3Tween3)
    // .addIncators()

    var scene15 = new ScrollMagic.Scene({offset: 8*height/4})
        .setTween(s3Tween4)
    // .addIncators()

// SCENE4
    var s4Tween = TweenMax.to(".scene4", 0, {display: 'block'})
    var s4Tween2 = TweenMax.to(".scene4", 0, {autoAlpha: 0})

    var scene16 = new ScrollMagic.Scene({offset: 8*height/4})
        .setTween(s4Tween)
    // .addIncators()


    var scene17 = new ScrollMagic.Scene({offset: 9*height/4})
        .setTween(s4Tween2)
    // .addIncators()

//SCENE5
    var s5Tween = TweenMax.to(".scene5", 0, {display: "block"})
    var s5Tween1 = TweenMax.to(".scene5__background", 5, {right: "-=500px"})
    var s5Tween2 = TweenMax.to(".scene5__puit", 5, {left: "+=500px"})
    var s5Tween3 = TweenMax.to(".scene5__child", 1, {autoAlpha: 0})
    var s5Tween4 = TweenMax.to(".scene5__background", 1, {autoAlpha: 0.5})
    var s5Tween5 = TweenMax.to(".scene5__foreuse", 1, {left: "+=550px"})
    var s5Tween6 = TweenMax.to(".scene5__paragraphe", 1, {opacity: "1"})
    var s5Tween7 = TweenMax.to(".scene5__nuage", 0, {display: "block"})
    var s5Tween8 = TweenMax.to(".scene5__nuage", 1, {scale: 1.3, ease: Bounce.easeOut})
    var s5Tween9 = new TimelineMax()
        .add(TweenMax.to(".scene5__paragraphe", 1, {autoAlpha: 0}))
        .add(TweenMax.to(".scene5__paragraphe2", 1, {autoAlpha: 1}))
    var s5Tween10 = TweenMax.to(".scene5", 1, {autoAlpha: 0})

    var scene18 = new ScrollMagic.Scene({offset: 9*height/4})
        .setTween(s5Tween)
    // .addIncators()

    var scene19 = new ScrollMagic.Scene({offset: 10*height/4, duration: height/2})
        .setTween(s5Tween1)
    // .addIncators()

    var scene20 = new ScrollMagic.Scene({offset: 10*height/4, duration: height/2})
        .setTween(s5Tween2)
    // .addIncators()

    var scene21 = new ScrollMagic.Scene({offset: 12*height/4})
        .setTween(s5Tween3)
    // .addIncators()


    var scene22 = new ScrollMagic.Scene({offset: 12*height/4})
        .setTween(s5Tween4)
    // .addIncators()

    var scene23 = new ScrollMagic.Scene({offset: 12*height/4, duration: height/4})
        .setTween(s5Tween5)
    // .addIncators()

    var scene24 = new ScrollMagic.Scene({offset: 12*height/4 + height/8})
        .setTween(s5Tween6)
    // .addIncators()

    var scene25 = new ScrollMagic.Scene({offset: 13*height/4})
        .setTween(s5Tween7)
    // .addIncators()

    var scene26 = new ScrollMagic.Scene({offset: 13*height/4, duration: height/4})
        .setTween(s5Tween8)
    // .addIncators()

    var scene27 = new ScrollMagic.Scene({offset: 13*height/4, duration: height/4})
        .setTween(s5Tween9)
    // .addIncators()

    var scene28 = new ScrollMagic.Scene({offset: 14*height/4})
        .setTween(s5Tween10)
    // .addIncators()

// SCENE6
    var s6Tween = TweenMax.to(".scene6", 0, {display: "block"})
    var s6Tween2 = TweenMax.to(".scene6__bubble1", 0, {autoAlpha: 0})
    var s6Tween3 = TweenMax.to(".scene6__bubble2", 0, {autoAlpha: 0})
    var s6Tween4 = TweenMax.to(".scene6__bubble3", 0, {display: "block"})
    var s6Tween5 = TweenMax.to(".scene6 p, .scene6__assos, .scene6__peuple", 0, {autoAlpha: 0.5})
    var s6Tween6 = TweenMax.to(".scene6__famille", 0, {display: "block"})
    var s6Tween7 = TweenMax.to(".scene6", 0, {autoAlpha: 0})

    var scene29 = new ScrollMagic.Scene({offset: 14*height/4})
        .setTween(s6Tween)
    // .addIncators()

    var scene30 = new ScrollMagic.Scene({offset: 15*height/4})
        .setTween(s6Tween2)
    // .addIncators()

    var scene31 = new ScrollMagic.Scene({offset: 15*height/4})
        .setTween(s6Tween3)
    // .addIncators()

    var scene32 = new ScrollMagic.Scene({offset: 15*height/4})
        .setTween(s6Tween4)
    // .addIncators()

    var scene33 = new ScrollMagic.Scene({offset: 16*height/4})
        .setTween(s6Tween5)
    // .addIncators()

    var scene34 = new ScrollMagic.Scene({offset: 16*height/4})
        .setTween(s6Tween6)
    // .addIncators()

    var scene35 = new ScrollMagic.Scene({offset: 17*height/4})
        .setTween(s6Tween7)
    // .addIncators()

// SCENE7
    var s7Tween = TweenMax.to(".scene7", 0, {display: "block"});
    var s7Tween2 = TweenMax.to(".scene7__bank", 0, {display: "inline-block"});
    var s7Tween3 = TweenMax.to(".scene7__coin", 0, {display: "block"});
    var s7Tween4 = new TimelineMax()
        .add(TweenMax.to(".scene7__famille", 0, {display: "none"}))
        .add(TweenMax.to(".scene7__bank", 0, {margin: "30vh 0 0 0"}))
        .add(TweenMax.to(".scene7__coin", 0, {left: "48vw"}))
    var s7Tween5 = TweenMax.to(".scene7", 0, {autoAlpha: 0})

    var scene36 = new ScrollMagic.Scene({offset: 17*height/4})
        .setTween(s7Tween)
    // .addIncators()

    var scene37 = new ScrollMagic.Scene({offset: 18*height/4})
        .setTween(s7Tween2)
    // .addIncators()

    var scene38 = new ScrollMagic.Scene({offset: 19*height/4})
        .setTween(s7Tween3)
    // .addIncators()

    var scene39 = new ScrollMagic.Scene({offset: 20*height/4})
        .setTween(s7Tween4)
    // .addIncators()

    var scene40 = new ScrollMagic.Scene({offset: 21*height/4})
        .setTween(s7Tween5)
    // .addIncators()

// SCENE8
    var s8Tween = TweenMax.to(".scene8", 0, {display: "block"});
    var s8Tween3 = TweenMax.to(".scene8__pompe2", 0, {display: "block"})
    var s8Tween4 = TweenMax.to(".scene8__paragraphe", 0, {display: "block"})
    var s8Tween5 = TweenMax.to(".scene8__technicien", 5, {left: "300px"})
    var s8Tween6 = TweenMax.to(".scene8__paragraphe", 0.5, {autoAlpha: 0})
    var s8Tween7 = TweenMax.to(".scene8__paragraphe", 0, {display: "none"})
    var s8Tween8 = TweenMax.to(".scene8__paragraphe2", 0.5, {display: "block"})
    var s8Tween9 = TweenMax.to(".scene8__paragraphe2", 0.5, {autoAlpha: 1})
    var s8Tween10 = TweenMax.to(".scene8__pompe2", 0, {autoAlpha: 0})
    var s8Tween11 = TweenMax.to(".scene8__cle", 0, {display: "block"})
    var s8Tween12 = TweenMax.to(".scene8__cle", 1, {scale: 1.2, ease: Bounce.easeOut})
    var s8Tween13 = TweenMax.to(".scene8__cle, .scene8__pompe2, .scene8__pompe, .scene8__paragraphe2", 1, {autoAlpha: 0})
    var s8Tween14 = TweenMax.to(".scene8__paragraphe2", 0, {display: "none"})
    var s8Tween15 = new TimelineMax()
        .add(TweenMax.to(".scene8__paragraphe3", 0, {display: "block"}))
        .add(TweenMax.to(".scene8__paragraphe3", 1, {autoAlpha: 1}))
    var s8Tween16 = TweenMax.to(".scene8__technicien", 5, {left: "+=1000px"})
    var s8Tween17 = new TimelineMax()
        .add(TweenMax.to(".scene8__bank", 0, {display: "block"}))
        .add(TweenMax.to(".scene8__bank", 1, {autoAlpha: 1}))
        .add(TweenMax.to(".scene8__arrow", 0, {display: "block"}))
        .add(TweenMax.to(".scene8__arrow", 1, {autoAlpha: 1}))
    var s8Tween18 = TweenMax.to(".scene8", 0, {autoAlpha: 0})

    var scene41 = new ScrollMagic.Scene({offset: 21*height/4})
        .setTween(s8Tween)
    // .addIncators()

    var scene43 = new ScrollMagic.Scene({offset: 22*height/4})
        .setTween(s8Tween3)
    // .addIncators()

    var scene44 = new ScrollMagic.Scene({offset: 22*height/4})
        .setTween(s8Tween4)
    // .addIncators()

    var scene45 = new ScrollMagic.Scene({offset: 22*height/4 + height/8, duration: height/4})
        .setTween(s8Tween5)
    // .addIncators()

    var scene46 = new ScrollMagic.Scene({offset: 23*height/4})
        .setTween(s8Tween6)
    // .addIncators()

    var scene47 = new ScrollMagic.Scene({offset: 23*height/4})
        .setTween(s8Tween7)
    // .addIncators()

    var scene48 = new ScrollMagic.Scene({offset: 23*height/4})
        .setTween(s8Tween8)
    // .addIncators()

    var scene49 = new ScrollMagic.Scene({offset: 23*height/4})
        .setTween(s8Tween9)
    // .addIncators()

    var scene50 = new ScrollMagic.Scene({offset: 24*height/4})
        .setTween(s8Tween10)
    // .addIncators()

    var scene51 = new ScrollMagic.Scene({offset: 24*height/4})
        .setTween(s8Tween11)
    // .addIncators()

    var scene52 = new ScrollMagic.Scene({offset: 24*height/4, duration: height/4})
        .setTween(s8Tween12)
    // .addIncators()

    var scene53 = new ScrollMagic.Scene({offset: 25*height/4, duration: height/8})
        .setTween(s8Tween13)
    // .addIncators()

    var scene54 = new ScrollMagic.Scene({offset: 25*height/4 + height/8})
        .setTween(s8Tween14)
    // .addIncators()

    var scene55 = new ScrollMagic.Scene({offset: 25*height/4 + height/8})
        .setTween(s8Tween15)
    // .addIncators()

    var scene56 = new ScrollMagic.Scene({offset: 25*height/4 + height/8, duration: height/4 + height/8})
        .setTween(s8Tween16)
    // .addIncators()

    var scene57 = new ScrollMagic.Scene({offset: 25*height/4 + height/8, duration: height/4 + height/8})
        .setTween(s8Tween17)
    // .addIncators()

    var scene58 = new ScrollMagic.Scene({offset: 28*height/4})
        .setTween(s8Tween18)
    // .addIncators()

// SCENE9
    var s9Tween = TweenMax.to(".scene9", 0, {display: "block"})
    var s9Tween2 = TweenMax.to(".scene9__arrow", 5, {rotation: 90})
    var s9Tween3 = TweenMax.to(".scene9__logo", 2, {autoAlpha: 1})

    var scene59 = new ScrollMagic.Scene({offset: 28*height/4})
        .setTween(s9Tween)
    // .addIncators()

    var scene60 = new ScrollMagic.Scene({offset: 28*height/4, duration: height/4})
        .setTween(s9Tween2)
    // .addIncators()

    var scene61 = new ScrollMagic.Scene({offset: 29*height/4})
        .setTween(s9Tween3)
    // .addIncators()

    controller.addScene([
        scene, scene2, scene3, scene4, scene5,
        scene6, scene7, scene8, scene9, scene10, scene11,
        scene12, scene13, scene14, scene15,
        scene16, scene17,
        scene18, scene19, scene20, scene21, scene22, scene23, scene24, scene25, scene26, scene27, scene28,
        scene29, scene30, scene31, scene32, scene33, scene34, scene35,
        scene36, scene37, scene38, scene39, scene40,
        scene41, scene43, scene44, scene45, scene46, scene47, scene48, scene49, scene50, scene51, scene52, scene53, scene54, scene55, scene56, scene57, scene58,
        scene59, scene60, scene61
    ]);
})

