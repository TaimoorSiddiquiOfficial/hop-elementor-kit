(()=>{"use strict";var e={n:t=>{var n=t&&t.__esModule?()=>t.default:()=>t;return e.d(n,{a:n}),n},d:(t,n)=>{for(var a in n)e.o(n,a)&&!e.o(t,a)&&Object.defineProperty(t,a,{enumerable:!0,get:n[a]})},o:(e,t)=>Object.prototype.hasOwnProperty.call(e,t)};const t=window.wp.element,n=window.wp.i18n,a=window.wp.url,l=window.wp.mediaUtils,i=window.wp.components,o=window.wp.primitives,m=(0,t.createElement)(o.SVG,{xmlns:"https://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,t.createElement)(o.Path,{d:"M18.2 17c0 .7-.6 1.2-1.2 1.2H7c-.7 0-1.2-.6-1.2-1.2V7c0-.7.6-1.2 1.2-1.2h3.2V4.2H7C5.5 4.2 4.2 5.5 4.2 7v10c0 1.5 1.2 2.8 2.8 2.8h10c1.5 0 2.8-1.2 2.8-2.8v-3.6h-1.5V17zM14.9 3v1.5h3.7l-6.4 6.4 1.1 1.1 6.4-6.4v3.7h1.5V3h-6.3z"})),r=(0,t.createElement)(o.SVG,{xmlns:"https://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,t.createElement)(o.Path,{d:"M4 15h11V9H4v6zM18.5 4v16H20V4h-1.5z"})),c=(0,t.createElement)(o.SVG,{xmlns:"https://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,t.createElement)(o.Path,{d:"M9 15h6V9H9v6zm-5 5h1.5V4H4v16zM18.5 4v16H20V4h-1.5z"})),s=(0,t.createElement)(o.SVG,{xmlns:"https://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,t.createElement)(o.Path,{d:"M9 9v6h11V9H9zM4 20h1.5V4H4v16z"})),u=window.wp.apiFetch;var _=e.n(u);const h=(0,t.createElement)(o.SVG,{xmlns:"https://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,t.createElement)(o.Path,{d:"M5 5v1.5h14V5H5zm0 7.8h14v-1.5H5v1.5zM5 19h14v-1.5H5V19z"})),d=(0,t.createElement)(o.SVG,{xmlns:"https://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,t.createElement)(o.Path,{d:"M13 11.8l6.1-6.3-1-1-6.1 6.2-6.1-6.2-1 1 6.1 6.3-6.5 6.7 1 1 6.5-6.6 6.5 6.6 1-1z"})),g="undefined"!=typeof hopEKitMenu?hopEKitMenu.fontAwesome.regular:[],E="undefined"!=typeof hopEKitMenu?hopEKitMenu.fontAwesome.solid:[],k="undefined"!=typeof hopEKitMenu?hopEKitMenu.fontAwesome.brands:[];function p(e){let{onChange:a,setOpen:l}=e;const[o,m]=(0,t.useState)(null),[r,c]=(0,t.useState)(null),[s,u]=(0,t.useState)(null),[_,h]=(0,t.useState)(""),[d,p]=(0,t.useState)(!0);return(0,t.useEffect)((()=>{_&&p(!0),m(g?g.icons.map((e=>!_||e.toLowerCase().includes(_.toLowerCase())?(0,t.createElement)("span",{className:"hop-ekits-menu__icon-component__icon",key:e,onClick:()=>{a(`far fa-${e}`),l(!1)}},(0,t.createElement)("i",{className:`far fa-${e}`})):null)):[]),c(E?E.icons.map((e=>!_||e.toLowerCase().includes(_.toLowerCase())?(0,t.createElement)("span",{className:"hop-ekits-menu__icon-component__icon",key:e,onClick:()=>{a(`fas fa-${e}`),l(!1)}},(0,t.createElement)("i",{className:`fas fa-${e}`})):null)):[]),u(k?k.icons.map((e=>!_||e.toLowerCase().includes(_.toLowerCase())?(0,t.createElement)("span",{className:"hop-ekits-menu__icon-component__icon",key:e,onClick:()=>{a(`fab fa-${e}`),l(!1)}},(0,t.createElement)("i",{className:`fab fa-${e}`})):null)):[]),p(!1)}),[_]),(0,t.createElement)(t.Fragment,null,d?(0,t.createElement)(i.Spinner,null):(0,t.createElement)(t.Fragment,null,(0,t.createElement)(i.TextControl,{value:_,placeholder:(0,n.__)("Search for FontAwesome…","hop-elementor-kit"),onChange:e=>h(e),style:{fontWeight:400}}),(0,t.createElement)("div",{className:"hop-ekits-menu__icon-component__icons"},o,r,s)))}function v(e){let{font:a,setFont:l}=e;const[o,m]=(0,t.useState)(!1);return(0,t.createElement)("div",{className:"hop-ekits-menu__icon-component"},(0,t.createElement)("span",{className:"hop-ekits-menu__icon-component__label"},(0,n.__)("Select Icons","hop-elementor-kit")),(0,t.createElement)("div",null,(0,t.createElement)("div",null,(0,t.createElement)("div",{className:"hop-ekits-menu__icon-component__select"},(0,t.createElement)(i.TextControl,{value:a,onChange:e=>l(e)}),(0,t.createElement)(i.Button,{className:"hop-ekits-menu__icon-component__button",isSecondary:!0,variant:"secondary",icon:o?d:h,onClick:()=>m(!o),"aria-expanded":o,label:"Select Icon"},o?(0,n.__)("CLOSE","hop-elementor-kit"):(0,n.__)("SELECT","hop-elementor-kit"))),o&&(0,t.createElement)("div",{className:"hop-ekits-menu__icon-component__list"},(0,t.createElement)(p,{onChange:l,setOpen:m})))))}function w(e){let{label:n,color:a,onChange:l}=e;const o=(0,t.useRef)(null),[m,r]=(0,t.useState)(!1);return(0,t.useEffect)((()=>{function e(e){o.current&&!o.current.contains(e.target)&&r(!1)}return document.addEventListener("click",e),()=>document.removeEventListener("click",e)}),[o]),(0,t.createElement)("div",{className:"hop-ekits-menu__icon-color",ref:o},(0,t.createElement)("div",{className:"hop-ekits-menu__icon__header"},(0,t.createElement)("span",{className:"hop-ekits-menu__icon-color__label"},n||""),(0,t.createElement)("div",{className:"hop-ekits-menu__icon-color__inner"},(0,t.createElement)("button",{className:"hop-ekits-menu__icon-color__indicator",style:{backgroundColor:a},onClick:()=>r(!m)}),(0,t.createElement)(i.TextControl,{value:a,onChange:e=>l(e),style:{height:30,width:160}}))),m&&(0,t.createElement)("div",{className:"hop-ekits-menu__icon-color__picker",style:{maxWidth:300}},(0,t.createElement)(i.ColorPicker,{color:a,onChangeComplete:e=>{let t;if(void 0===e.rgb||1===e.rgb.a)t=e.hex;else{const{r:n,g:a,b:l,a:i}=e.rgb;t=`rgba(${n}, ${a}, ${l}, ${i})`}l(t)},disableAlpha:!0})))}function C(e){let{open:a,setOpen:l,openIframe:o,menuItemID:m}=e;const[r,c]=(0,t.useState)({}),[s,u]=(0,t.useState)(!1);return(0,t.useEffect)((()=>{u(!0);try{async function e(){const e=await _()({method:"POST",path:"hop-ekits-megamenu/create-megamenu",data:{menu_item_id:m||""}});"success"===e?.status&&c(e.data),u(!1)}o&&e()}catch(t){u(!1)}}),[o]),(0,t.createElement)(i.Modal,{className:"hop-ekits-menu__modal__iframe",focusOnMount:!0,shouldCloseOnEsc:!0,shouldCloseOnClickOutside:!1,onRequestClose:()=>l(!1),title:(0,n.__)("Hop Elementor Editor","hop-elementor-kit")},s?(0,t.createElement)(i.Spinner,null):(0,t.createElement)(t.Fragment,null,r?.url?(0,t.createElement)("div",{className:"hop-ekits-menu__modal__iframe__inner"},(0,t.createElement)("iframe",{src:r.url,title:(0,n.__)("Hop Elementor Editor","hop-elementor-kit"),width:"100%",height:"100%"})):(0,t.createElement)("p",null,(0,n.__)("Can't view Editor","hop-elementor-kit"))))}const S={id:null,name:null,url:null},f={status:"",message:""},b=window.hopEKitMenu.menuContainer;function y(e){let{setOpen:o,menuItemID:u}=e;const[h,d]=(0,t.useState)(!1),[g,E]=(0,t.useState)(!1),[k,p]=(0,t.useState)(!1),[y,M]=(0,t.useState)(f),[N,T]=(0,t.useState)(!1),[B,x]=(0,t.useState)(!1),[I,z]=(0,t.useState)("icon"),[P,O]=(0,t.useState)(""),[V,H]=(0,t.useState)(S),[F,D]=(0,t.useState)(""),[G,L]=(0,t.useState)(""),[A,$]=(0,t.useState)(""),[K,R]=(0,t.useState)(""),[U,W]=(0,t.useState)(!1),[j,q]=(0,t.useState)(""),[Q,J]=(0,t.useState)(""),[X,Y]=(0,t.useState)(""),[Z,ee]=(0,t.useState)(""),[te,ne]=(0,t.useState)(""),[ae,le]=(0,t.useState)("screen"),[ie,oe]=(0,t.useState)("right");return(0,t.useEffect)((()=>{E(!0);try{async function e(){const e=await _()({method:"GET",path:(0,a.addQueryArgs)("hop-ekits-megamenu/get",{menu_item_id:u||"",nocache:Date.now()})});"success"===e.status&&e.data&&(T(e.data.enableMegaMenu),x(e.data.enableIcon),z(e.data.iconType),O(e.data.icon),H(e.data.iconUpload),D(e.data.iconColor),L(e.data.iconSize),W(e.data.enableBadge),q(e.data.badgeText),J(e.data.badgeColor),Y(e.data.badgeBgColor),ee(e.data.badgeSize),$(e.data.iconWidth),R(e.data.iconHeight),ne(e.data.widthMenu),oe(e.data.menuPosition),le(e.data.menuType)),E(!1)}e()}catch(t){console.log(t),E(!1)}}),[]),(0,t.createElement)(t.Fragment,null,(0,t.createElement)(i.Modal,{className:"hop-ekits-menu__modal",focusOnMount:!0,shouldCloseOnEsc:!0,shouldCloseOnClickOutside:!1,title:(0,n.__)("Hop Mega Menu Settings","hop-elementor-kit"),onRequestClose:e=>{e&&e.target&&!e.target.classList.contains("hop-ekits-menu__modal__content__edit_ele_button")&&o(!1)}},(0,t.createElement)(i.TabPanel,{tabs:[{name:"general",title:(0,n.__)("General","hop-elementor-kit")},{name:"icon",title:(0,n.__)("Icon","hop-elementor-kit")},{name:"badge",title:(0,n.__)("Badge","hop-elementor-kit")},{name:"settings",title:(0,n.__)("Settings","hop-elementor-kit")}]},(e=>g?(0,t.createElement)("div",{className:"hop-ekits-menu__modal__content"},(0,t.createElement)(i.Spinner,null)):"general"===e.name?(0,t.createElement)("div",{className:"hop-ekits-menu__modal__content"},(0,t.createElement)(i.ToggleControl,{label:(0,n.__)("Enable Mega Menu","hop-elementor-kit"),checked:N,onChange:()=>T(!N)}),N&&(0,t.createElement)(i.Button,{isPrimary:!0,variant:"primary",icon:m,iconSize:20,onClick:()=>d(!h),className:"hop-ekits-menu__modal__content__edit_ele_button"},(0,n.__)("Edit with Elementor","hop-elementor-kit"))):"icon"===e.name?(0,t.createElement)("div",{className:"hop-ekits-menu__modal__content"},(0,t.createElement)(i.ToggleControl,{label:(0,n.__)("Enable Menu Icon","hop-elementor-kit"),checked:B,onChange:()=>x(!B)}),B&&(0,t.createElement)(t.Fragment,null,(0,t.createElement)(i.SelectControl,{label:(0,n.__)("Icon type","hop-elementor-kit"),value:I,options:[{label:(0,n.__)("Icons","hop-elementor-kit"),value:"icon"},{label:(0,n.__)("Upload","hop-elementor-kit"),value:"upload"}],onChange:e=>z(e)}),"icon"===I&&(0,t.createElement)(t.Fragment,null,(0,t.createElement)(v,{font:P,setFont:O}),(0,t.createElement)(w,{label:(0,n.__)("Icon color","hop-elementor-kit"),color:F,onChange:D}),(0,t.createElement)(i.TextControl,{label:(0,n.__)("Icon size","hop-elementor-kit"),placeholder:(0,n.__)("Enter the font size…","hop-elementor-kit"),value:G,onChange:e=>L(e)})),"upload"===I&&(0,t.createElement)(t.Fragment,null,(0,t.createElement)("div",{className:"hop-ekits-menu__icon-upload "+(V.name?"hop-ekits-menu__icon-upload--has":"")},V.name&&(0,t.createElement)("div",{className:"hop-ekits-menu__icon-upload__name"},(0,t.createElement)("img",{src:V.url,alt:""}),(0,t.createElement)("div",null,V.name)),(0,t.createElement)(l.MediaUpload,{onSelect:e=>{H({id:e.id,name:e.filename,url:e.url})},allowedTypes:["image"],value:V.url,render:e=>{let{open:a}=e;return(0,t.createElement)(i.ButtonGroup,null,(0,t.createElement)(i.Button,{onClick:a,variant:"primary",isPrimary:!0,style:{height:31,marginRight:10}},V?.url?(0,n.__)("Replace","hop-elementor-kit"):(0,n.__)("Upload","hop-elementor-kit")),V.name&&(0,t.createElement)(i.Button,{onClick:()=>H(S),variant:"secondary",isSecondary:!0,style:{height:31}},(0,n.__)("Remove","hop-elementor-kit")))}})),(0,t.createElement)(i.TextControl,{label:(0,n.__)("Icon width","hop-elementor-kit"),value:A,onChange:e=>$(e)}),(0,t.createElement)(i.TextControl,{label:(0,n.__)("Icon height","hop-elementor-kit"),value:K,onChange:e=>R(e)})))):"badge"===e.name?(0,t.createElement)("div",{className:"hop-ekits-menu__modal__content"},(0,t.createElement)(i.ToggleControl,{label:(0,n.__)("Enable Menu Badge","hop-elementor-kit"),checked:U,onChange:()=>W(!U)}),U&&(0,t.createElement)(t.Fragment,null,(0,t.createElement)(i.TextControl,{label:(0,n.__)("Badge text","hop-elementor-kit"),value:j,onChange:e=>q(e)}),(0,t.createElement)(w,{label:(0,n.__)("Badge color","hop-elementor-kit"),color:Q,onChange:J}),(0,t.createElement)(w,{label:(0,n.__)("Badge background color","hop-elementor-kit"),color:X,onChange:Y}),(0,t.createElement)(i.TextControl,{label:(0,n.__)("Badge size","hop-elementor-kit"),placeholder:(0,n.__)("Enter the font size…","hop-elementor-kit"),value:Z,onChange:e=>ee(e)}))):"settings"===e.name?(0,t.createElement)("div",{className:"hop-ekits-menu__modal__content"},(0,t.createElement)(i.TextControl,{label:(0,n.__)("Mega menu content width","hop-elementor-kit"),help:(0,n.__)("Set the width of the mega menu content. Example: 1140px, 100vw…","hop-elementor-kit"),value:te,onChange:e=>ne(e)}),b&&(0,t.createElement)(i.SelectControl,{label:(0,n.__)("Mega menu align type","hop-elementor-kit"),value:ae,options:[{label:(0,n.__)("Align with Screen","hop-elementor-kit"),value:"screen"},{label:(0,n.__)("Align with Container","hop-elementor-kit"),value:"container"}],onChange:e=>le(e)}),(0,t.createElement)("p",{style:{marginBottom:8}},(0,n.__)("Mega menu position","hop-elementor-kit")),(0,t.createElement)(i.ButtonGroup,null,(0,t.createElement)(i.Button,{isPrimary:"left"===ie,onClick:()=>oe("left"),icon:r}),(0,t.createElement)(i.Button,{isPrimary:"center"===ie,onClick:()=>oe("center"),icon:c}),(0,t.createElement)(i.Button,{icon:s,isPrimary:"right"===ie,onClick:()=>oe("right")}))):void 0)),(0,t.createElement)("div",{className:"hop-ekits-menu__modal__footer"},(0,t.createElement)(i.Button,{isPrimary:!0,variant:"primary",icon:k?(0,t.createElement)(i.Spinner,null):"",iconSize:20,onClick:async function(){p(!0);try{const e=await _()({method:"POST",path:"hop-ekits-megamenu/save",data:{menu_item_id:u,options:{enableMegaMenu:N,enableIcon:B,iconType:I,icon:P,iconUpload:V,iconColor:F,iconSize:G,iconWidth:A,iconHeight:K,enableBadge:U,badgeText:j,badgeColor:Q,badgeBgColor:X,badgeSize:Z,widthMenu:te,menuPosition:ie,menuType:ae}}});M({...y,...e}),p(!1)}catch(e){M({...y,status:"error",message:e.message||(0,n.__)("Error when saving","hop-elementor-kit")}),p(!1)}const e=setTimeout((()=>{M(f)}),1500);return()=>clearTimeout(e)},style:{marginRight:10}},(0,n.__)("Save","hop-elementor-kit")),(0,t.createElement)(i.Button,{isSecondary:!0,variant:"secondary",iconSize:20,onClick:()=>o(!1)},(0,n.__)("Close","hop-elementor-kit")),y.status&&y.message&&(0,t.createElement)("div",{className:"hop-ekits-menu__modal__notice"},(0,t.createElement)(i.Notice,{status:y.status,isDismissible:!1},y.message)))),h&&(0,t.createElement)(C,{setOpen:d,menuItemID:u,openIframe:h}))}function M(e){let{menuItemID:a}=e;const[l,i]=(0,t.useState)(!1);return(0,t.createElement)(t.Fragment,null,(0,t.createElement)("a",{href:"#",className:"hop-ekits-menu__item button button-primary",onClick:e=>{e.preventDefault(),i(!l)}},(0,n.__)("Hop Mega Menu","hop-elementor-kit")),l&&(0,t.createElement)(y,{setOpen:i,menuItemID:a}))}document.querySelectorAll(".hop-ekits-menu").forEach((e=>{const n=e.dataset.id||"";wp.element.render((0,t.createElement)(M,{menuItemID:n}),e)})),wp.element.render((0,t.createElement)((function(){const[e,l]=(0,t.useState)(""),[o,m]=(0,t.useState)(!1),[r,c]=(0,t.useState)(!1),[s,u]=(0,t.useState)({status:"",message:""});return(0,t.useEffect)((()=>{const e=document.getElementById("nav-menu-meta-object-id");e&&l(e.value)}),[]),(0,t.useEffect)((()=>{e&&async function(){const t=await _()({method:"GET",path:(0,a.addQueryArgs)("hop-ekits-megamenu/get-settings",{menuID:e})});"success"===t.status&&m(t?.data?.enable)}()}),[e]),(0,t.createElement)("div",{className:"hop-ekits-menu__settings"},(0,t.createElement)(i.CheckboxControl,{label:(0,n.__)("Enable Mega Menu","hop-elementor-kit"),checked:o,onChange:()=>m(!o)}),(0,t.createElement)(i.Button,{isPrimary:!0,variant:"primary",icon:r?(0,t.createElement)(i.Spinner,null):"",onClick:async function(){c(!0);try{const t=await _()({method:"POST",path:"hop-ekits-megamenu/save-settings",data:{menuID:e,enableMegaMenu:o}});c(!1),u({status:"success",message:t.message||""})}catch(e){c(!1),u({status:"error",message:e.message||"Error"})}}},(0,n.__)("Save","hop-elementor-kit")),s.status&&(0,t.createElement)(i.Notice,{status:s.status,isDismissible:!1},s.message))}),null),document.getElementById("hop-ekits-menu__settings"))})();