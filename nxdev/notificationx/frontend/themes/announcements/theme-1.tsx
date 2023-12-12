import React, { useEffect, useRef, useState } from "react";

const Theme1 = ({ offer_discount, link_text, link_button_bg_color, link_button_text_color, announcementCSS }) => {
    const ref = useRef();

    return (
        <svg
            width="92"
            height="98"
            viewBox="0 0 92 98"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
                d="M10 0H82V78C82 84.6274 76.6274 90 70 90H22C15.3726 90 10 84.6274 10 78V0Z"
                fill={ announcementCSS?.discountBackground ? announcementCSS?.discountBackground : "#4F19CD" }
            />
            <path d="M82 0L87 5L92 10H82V0Z" fill={ announcementCSS?.discountBackground ? announcementCSS?.discountBackground : "#806FF6" } />
            <path d="M10 0L5 5L0 10H10V0Z" fill={ announcementCSS?.discountBackground ? announcementCSS?.discountBackground : "#806FF6" } />
            <g>
                <text
                    ref={ref}
                    xmlSpace="preserve"
                    style={{whiteSpace: "pre"} }
                    fontFamily="DM Sans"
                    fontSize="24"
                    fontWeight="bold"
                    letterSpacing="0em"
                    fill={ announcementCSS?.discountTextColor ? announcementCSS?.discountTextColor : "#fff" }
                >
                    <tspan x="16" y="53.548" >
                        {offer_discount}
                        <tspan fontSize="14">%</tspan>
                    </tspan>
                </text>
            </g>
            <g filter="url(#filter1_d_620_42)">
                <text
                    xmlSpace="preserve"
                    style={{whiteSpace: "pre"}}
                    fontFamily="DM Sans"
                    fontSize="16"
                    fontWeight="bold"
                    letterSpacing="0em"
                    fill={ announcementCSS?.discountTextColor ? announcementCSS?.discountTextColor : "#fff" }
                >
                    <tspan x="37" y="73.456">
                        OFF
                    </tspan>
                </text>
            </g>
            <rect x="13" y="3" width="66" height="17" rx="2" fill={ announcementCSS?.linkButtonBgColor ? announcementCSS?.linkButtonBgColor : '#806FF6' } />
            <g filter="url(#filter2_d_620_42)">
                <text
                    fill={ announcementCSS?.linkButtonTextColor ? announcementCSS?.linkButtonTextColor : '#fff' }
                    xmlSpace="preserve"
                    style={{whiteSpace: "pre", backgroundColor: link_button_bg_color, color: link_button_text_color}}
                    fontFamily="DM Sans"
                    fontSize="10"
                    fontWeight="500"
                    letterSpacing="0em"
                >
                    <tspan x="22.709" y="14">
                        {link_text}
                    </tspan>
                </text>
            </g>
            <defs>
                <filter
                    id="filter0_d_620_42"
                    x="21.428"
                    y="34.064"
                    width="45.2434"
                    height="21.272"
                    filterUnits="userSpaceOnUse"
                    colorInterpolationFilters="sRGB"
                >
                    <feFlood floodOpacity="0" result="BackgroundImageFix" />
                    <feColorMatrix
                        in="SourceAlpha"
                        type="matrix"
                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                        result="hardAlpha"
                    />
                    <feOffset dy="1" />
                    <feComposite in2="hardAlpha" operator="out" />
                    <feColorMatrix
                        type="matrix"
                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"
                    />
                    <feBlend
                        mode="normal"
                        in2="BackgroundImageFix"
                        result="effect1_dropShadow_620_42"
                    />
                    <feBlend
                        mode="normal"
                        in="SourceGraphic"
                        in2="effect1_dropShadow_620_42"
                        result="shape"
                    />
                </filter>
                <filter
                    id="filter1_d_620_42"
                    x="37.72"
                    y="61.608"
                    width="29.0688"
                    height="12.584"
                    filterUnits="userSpaceOnUse"
                    colorInterpolationFilters="sRGB"
                >
                    <feFlood floodOpacity="0" result="BackgroundImageFix" />
                    <feColorMatrix
                        in="SourceAlpha"
                        type="matrix"
                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                        result="hardAlpha"
                    />
                    <feOffset dy="1" />
                    <feComposite in2="hardAlpha" operator="out" />
                    <feColorMatrix
                        type="matrix"
                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"
                    />
                    <feBlend
                        mode="normal"
                        in2="BackgroundImageFix"
                        result="effect1_dropShadow_620_42"
                    />
                    <feBlend
                        mode="normal"
                        in="SourceGraphic"
                        in2="effect1_dropShadow_620_42"
                        result="shape"
                    />
                </filter>
                <filter
                    id="filter2_d_620_42"
                    x="23.1689"
                    y="6.8"
                    width="45.9189"
                    height="8.31999"
                    filterUnits="userSpaceOnUse"
                    colorInterpolationFilters="sRGB"
                >
                    <feFlood floodOpacity="0" result="BackgroundImageFix" />
                    <feColorMatrix
                        in="SourceAlpha"
                        type="matrix"
                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                        result="hardAlpha"
                    />
                    <feOffset dy="1" />
                    <feComposite in2="hardAlpha" operator="out" />
                    <feColorMatrix
                        type="matrix"
                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"
                    />
                    <feBlend
                        mode="normal"
                        in2="BackgroundImageFix"
                        result="effect1_dropShadow_620_42"
                    />
                    <feBlend
                        mode="normal"
                        in="SourceGraphic"
                        in2="effect1_dropShadow_620_42"
                        result="shape"
                    />
                </filter>
            </defs>
        </svg>
    );
};

export default Theme1;
