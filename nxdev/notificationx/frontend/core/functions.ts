export const isArray = (args) => {
    return args !== null && typeof args === "object" && Array.isArray(args);
};

export const isObject = (obj) => {
    return obj !== null && typeof obj === 'object' && !isArray(obj)
}

export function addParentSelectorToCSS(htmlContent) {
    let tempDiv = document.createElement('div');
    tempDiv.innerHTML = htmlContent;
    let styleElements = tempDiv.querySelectorAll('style');
    let section =  tempDiv.querySelector('section[data-id]');
    if( section && styleElements?.length > 0 ) {
        let dataId = section.getAttribute('data-id');
        let parentSelector = `.elementor-element-${dataId}`;
        styleElements.forEach(styleElement => {
            let cssText = styleElement.innerHTML;
            cssText = cssText.replace(/([^\r\n,{}]+)(\s*\{)/g, `${parentSelector} $1$2`);
            styleElement.innerHTML = cssText;
        });
        return tempDiv.innerHTML;
    }
    return htmlContent;
}

export const getThemeName = (settings) => {
    let themeName = settings.themes.replace(settings.source + "_", "");
    themeName = themeName.replace(settings.type + "_", "");
    if (settings?.custom_type) {
        themeName = themeName.replace(settings?.custom_type + "_", "");
    }
    return themeName;
};
export const getResThemeName = (settings) => {
    let themeName;
    if( settings?.responsive_themes ) {
        themeName = settings.responsive_themes.replace(settings.source + "_", "");
        themeName = themeName.replace(settings.type + "_", "");
        if (settings?.custom_type) {
            themeName = themeName.replace(settings?.custom_type + "_", "");
        }
    }
    return themeName;
};

export function calculateAnimationStartTime(userInput, animationType) {
    const allowedAnimations = [
        'animate__slideOutDown',
        'animate__slideOutLeft',
        'animate__slideOutRight',
        'animate__slideOutUp',
    ];
    if( !allowedAnimations.includes(animationType) ){
        return 99.5;
    }

    let result;
    switch (true) {
        case userInput < 3:
            result = 75;
        case userInput < 5:
            result = 80;
            break;
        case userInput >= 5 && userInput <= 8:
            result = 85;
            break;
        case userInput > 8 && userInput <= 10:
            result = 93;
            break;
        case userInput > 10 && userInput <= 13:
            result = 95;
            break;
        case userInput > 13 && userInput <= 16:
            result = 93 + (userInput - 13) * 1.5;
            break;
        case userInput > 16 && userInput <= 20:
            result = 95 + (userInput - 16) * 0.5;
            break;
        default:
            result = 97;
    }

    return result;
}

class NotificationXHelpers {
    getPath = (rest, path, query = {}) => {
        query = {...query, frontend: 'true'}
        const url = new URL(`${rest.root}${rest.namespace}/${path}`);
        for (var key in query) {
            if (!query.hasOwnProperty(key)) continue;
            url.searchParams.set(key, query[key]);
        }
        return url.toString();
    };
    post = (url, data = {}, args = {}) => {
        return fetch(url, {
            method: 'POST',
            credentials: 'omit',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data),
            ...args,
        })
        .then(response => response.json())
        .catch((err) => console.error(err));
    };
}

const nxHelper = new NotificationXHelpers();

export default nxHelper;
