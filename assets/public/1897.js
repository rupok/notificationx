(globalThis.webpackChunknotificationx=globalThis.webpackChunknotificationx||[]).push([[1897],{1897:function(a,u,e){!function(a){"use strict";var u="nolla yksi kaksi kolme neljä viisi kuusi seitsemän kahdeksan yhdeksän".split(" "),e=["nolla","yhden","kahden","kolmen","neljän","viiden","kuuden",u[7],u[8],u[9]];function n(a,n,i,t){var s="";switch(i){case"s":return t?"muutaman sekunnin":"muutama sekunti";case"ss":s=t?"sekunnin":"sekuntia";break;case"m":return t?"minuutin":"minuutti";case"mm":s=t?"minuutin":"minuuttia";break;case"h":return t?"tunnin":"tunti";case"hh":s=t?"tunnin":"tuntia";break;case"d":return t?"päivän":"päivä";case"dd":s=t?"päivän":"päivää";break;case"M":return t?"kuukauden":"kuukausi";case"MM":s=t?"kuukauden":"kuukautta";break;case"y":return t?"vuoden":"vuosi";case"yy":s=t?"vuoden":"vuotta"}return function(a,n){return a<10?n?e[a]:u[a]:a}(a,t)+" "+s}a.defineLocale("fi",{months:"tammikuu_helmikuu_maaliskuu_huhtikuu_toukokuu_kesäkuu_heinäkuu_elokuu_syyskuu_lokakuu_marraskuu_joulukuu".split("_"),monthsShort:"tammi_helmi_maalis_huhti_touko_kesä_heinä_elo_syys_loka_marras_joulu".split("_"),weekdays:"sunnuntai_maanantai_tiistai_keskiviikko_torstai_perjantai_lauantai".split("_"),weekdaysShort:"su_ma_ti_ke_to_pe_la".split("_"),weekdaysMin:"su_ma_ti_ke_to_pe_la".split("_"),longDateFormat:{LT:"HH.mm",LTS:"HH.mm.ss",L:"DD.MM.YYYY",LL:"Do MMMM[ta] YYYY",LLL:"Do MMMM[ta] YYYY, [klo] HH.mm",LLLL:"dddd, Do MMMM[ta] YYYY, [klo] HH.mm",l:"D.M.YYYY",ll:"Do MMM YYYY",lll:"Do MMM YYYY, [klo] HH.mm",llll:"ddd, Do MMM YYYY, [klo] HH.mm"},calendar:{sameDay:"[tänään] [klo] LT",nextDay:"[huomenna] [klo] LT",nextWeek:"dddd [klo] LT",lastDay:"[eilen] [klo] LT",lastWeek:"[viime] dddd[na] [klo] LT",sameElse:"L"},relativeTime:{future:"%s päästä",past:"%s sitten",s:n,ss:n,m:n,mm:n,h:n,hh:n,d:n,dd:n,M:n,MM:n,y:n,yy:n},dayOfMonthOrdinalParse:/\d{1,2}\./,ordinal:"%d.",week:{dow:1,doy:4}})}(e(381))}}]);