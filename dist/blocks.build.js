!function(e){function t(l){if(n[l])return n[l].exports;var r=n[l]={i:l,l:!1,exports:{}};return e[l].call(r.exports,r,r.exports,t),r.l=!0,r.exports}var n={};t.m=e,t.c=n,t.d=function(e,n,l){t.o(e,n)||Object.defineProperty(e,n,{configurable:!1,enumerable:!0,get:l})},t.n=function(e){var n=e&&e.__esModule?function(){return e.default}:function(){return e};return t.d(n,"a",n),n},t.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},t.p="",t(t.s=0)}([function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});n(1)},function(e,t,n){"use strict";var l=n(2),r=(n.n(l),n(3)),c=(n.n(r),n(4)),__=(n.n(c),wp.i18n.__),o=function(){return wp.element.createElement(c.ServerSideRender,{block:"cgb/block-wp-menus-block"})};(0,wp.blocks.registerBlockType)("cgb/block-wp-menus-block",{title:__("Menu Select"),icon:"menu",category:"common",keywords:[__("wp-menus-block \u2014 CGB Block"),__("CGB Example"),__("create-guten-block")],attributes:{"menu-id":{type:Number,default:null}},edit:function(e){return console.log("edit fired",e),wp.element.createElement("div",{className:e.className},wp.element.createElement(o,null))},save:function(e){return console.log("save fired",e),wp.element.createElement("div",null,wp.element.createElement("p",null,"\u2014 Hello from the frontend."),wp.element.createElement("p",null,"CGB BLOCK: ",wp.element.createElement("code",null,"wp-menus-block")," is a new Gutenberg block."),wp.element.createElement("p",null,"It was created via"," ",wp.element.createElement("code",null,wp.element.createElement("a",{href:"https://github.com/ahmadawais/create-guten-block"},"create-guten-block")),"."))}})},function(e,t){},function(e,t){},function(e,t){e.exports=wp.components}]);