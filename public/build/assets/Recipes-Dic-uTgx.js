import{L as D}from"./frontend-D-j38Rbl.js";import{r as d,j as L,x as $,Q as M,c as B,w as I,o,b as e,f as l,aV as F,g as _,t as r,p,F as u,d as k,l as V}from"./app-CwBi2FLC.js";import{_ as z}from"./_plugin-vue_export-helper-DlAUqK2U.js";const N={class:"mt-10 mb-10"},P={class:"text-black-100 text-center text-large font-bold drop-shadow-xl mb-4"},T={class:"flex flex-wrap justify-center gap-10"},E={class:"relative w-full h-[250px]"},A=["src","alt"],U={class:"p-4 flex flex-col flex-grow"},Y={class:"text-large font-semibold text-gray-800"},Q={class:"text-gray-400 text-small"},S=["onClick"],X={class:"mt-2 text-gray-600 text-small line-clamp-3 text-justify"},G={class:"mt-auto flex items-center justify-between pt-4"},K=["href"],O={class:"flex items-center"},q={class:"text-gray-600 text-normal mr-1"},H={key:0,class:"flex"},J={class:"w-5 h-5 text-yellow-500 animate-shine",xmlns:"http://www.w3.org/2000/svg",fill:"currentColor",viewBox:"0 0 24 24",stroke:"currentColor"},W={class:"w-5 h-5 text-gray-300",xmlns:"http://www.w3.org/2000/svg",fill:"currentColor",viewBox:"0 0 24 24",stroke:"currentColor"},Z={key:1,class:"text-gray-500 text-[15px] italic"},ee={class:"flex flex-col items-center mb-10"},te={class:"w-[40vh] h-[350px] overflow-hidden rounded-tl-[40px] rounded-bl-[40px]"},se=["src","alt"],oe={class:"flex-1 p-[1vh] rounded-r-lg bg-gray-100"},le={class:"text-large font-bold mt-4 mb-4 ml-10 text-black-100"},ne={class:"text-gray-400 text-small mb-4 ml-10"},re=["onClick"],ae={class:"text-gray-600 text-small py-1 ml-10 pr-4 text-justify"},ie={class:"flex items-center justify-between mt-6 ml-10"},ce=["href"],de={__name:"Recipes",props:{famousDelights:Array,recentRecipes:Array,chefs:Array},setup(v){const h=d(!1),g=d(0),w=d(0),R=n=>{g.value=n.clientX-0,w.value=n.clientY-150},C=v,f=d(""),b=d([]),j=L(()=>f.value?b.value:C.famousDelights),y=async n=>{if(n){f.value=n;const t=await V.get(`/recipes/by-chef/${n}`);b.value=t.data}};return $(()=>{const{auth:n}=M().props;if(n.user){const t=document.createElement("script");t.src="https://cdn.botpress.cloud/webchat/v2.2/inject.js",document.head.appendChild(t);const s=document.createElement("script");s.src="https://files.bpcontent.cloud/2024/12/16/16/20241216164133-I8MIRLQE.js",document.head.appendChild(s)}}),(n,t)=>(o(),B(D,null,{default:I(()=>[e("div",{class:"relative h-[362px] overflow-hidden",onMouseenter:t[0]||(t[0]=s=>h.value=!0),onMouseleave:t[1]||(t[1]=s=>h.value=!1)},[t[3]||(t[3]=e("div",{class:"absolute inset-0 bg-cover bg-center",style:{"background-image":"url('https://c.animaapp.com/IjUIznOY/img/hero-image-1.png')",filter:"brightness(0.5)"}},null,-1)),h.value?(o(),l("div",{key:0,class:"absolute pointer-events-none w-[100px] h-[100px] bg-yellow-300 opacity-70 rounded-full blur-3xl",style:F({transform:`translate(${g.value-50}px, ${w.value-50}px)`,transition:"transform 50ms linear"})},null,4)):_("",!0),e("div",{class:"flex items-center justify-center h-full relative z-10",onMousemove:R},t[2]||(t[2]=[e("p",{class:"text-white text-center px-4 text-large font-bold drop-shadow-xl"}," Discover and savor the rich flavors of Filipino snack culture at Kusina Delights! ",-1)]),32)],32),e("div",N,[e("p",P,r(f.value?"Filtered Recipes":"Famous Filipino Delights"),1),e("div",T,[(o(!0),l(u,null,p(j.value,(s,x)=>{var a,i;return o(),l("div",{key:x,class:"max-w-[403px] bg-white rounded-[40px] shadow-lg overflow-hidden flex flex-col transform transition-transform duration-300 hover:scale-105 hover:shadow-xl"},[e("div",E,[e("img",{src:s.RecipePhoto?`/storage/${s.RecipePhoto}`:"https://via.placeholder.com/403x212",class:"absolute inset-0 w-full h-full object-cover",alt:s.RecipeTitle},null,8,A)]),e("div",U,[e("div",null,[e("h2",Y,r(s.RecipeTitle),1),e("p",Q,[t[4]||(t[4]=k(" Chef: ")),e("button",{onClick:m=>{var c;return y((c=s.chef)==null?void 0:c.ChefID)},class:"hover:text-yellow-500 hover:underline focus:outline-none"},r(((i=(a=s.chef)==null?void 0:a.user)==null?void 0:i.name)||"Unknown Chef"),9,S)]),e("p",X,r(s.Description),1)]),e("div",G,[e("a",{href:`api/recipes/${s.RecipeID}`},t[5]||(t[5]=[e("button",{class:"bg-yellow-300 text-black-100 font-bold py-1 px-4 rounded-full text-small font-semibold hover:bg-yellow-500 focus:outline-none focus:ring focus:ring-yellow-300"}," View Recipe ",-1)]),8,K),e("div",O,[e("span",q,[s.reviews_count>0?(o(),l("div",H,[(o(!0),l(u,null,p(Math.round(s.reviews_avg_star)||0,m=>(o(),l("svg",J,t[6]||(t[6]=[e("path",{d:"M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"},null,-1)])))),256)),(o(!0),l(u,null,p(5-Math.round(s.reviews_avg_star)||0,m=>(o(),l("svg",W,t[7]||(t[7]=[e("path",{d:"M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"},null,-1)])))),256))])):(o(),l("span",Z,"Not reviewed yet"))])])])])])}),128))])]),f.value?_("",!0):(o(),l(u,{key:0},[t[10]||(t[10]=e("h2",{class:"text-5xl font-bold mb-8 text-center"},"Recent Recipes",-1)),e("div",ee,[(o(!0),l(u,null,p(v.recentRecipes,(s,x)=>{var a,i;return o(),l("div",{key:x,class:"bg-gray-100 shadow-lg rounded-tr-[40px] rounded-br-[40px] rounded-tl-[40px] rounded-bl-[40px] flex items-center w-[98%] max-w-screen-xl mb-10 transform transition-transform duration-300 hover:scale-105 hover:shadow-xl"},[e("div",te,[e("img",{src:s.RecipePhoto?`/storage/${s.RecipePhoto}`:"https://via.placeholder.com/403x212",class:"w-full h-full object-cover",alt:s.RecipeTitle},null,8,se)]),e("div",oe,[e("h3",le,r(s.RecipeTitle),1),e("p",ne,[t[8]||(t[8]=k(" Chef: ")),e("button",{onClick:m=>{var c;return y((c=s.chef)==null?void 0:c.ChefID)},class:"hover:text-yellow-500 hover:underline focus:outline-none"},r(((i=(a=s.chef)==null?void 0:a.user)==null?void 0:i.name)||"Unknown Chef"),9,re)]),e("p",ae,r(s.Description),1),e("div",ie,[e("a",{href:`api/recipes/${s.RecipeID}`},t[9]||(t[9]=[e("button",{class:"bg-yellow-300 text-black-100 font-bold py-1 px-4 rounded-full text-small font-semibold hover:bg-yellow-500 focus:outline-none focus:ring focus:ring-yellow-300"}," View Recipe ",-1)]),8,ce)])])])}),128))])],64))]),_:1}))}},he=z(de,[["__scopeId","data-v-f7721fc7"]]);export{he as default};
