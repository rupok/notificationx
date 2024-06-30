import apiFetch from "@wordpress/api-fetch";
import { sprintf, __ } from "@wordpress/i18n";
import Swal from "sweetalert2";
import { useNotificationXContext } from "../hooks";
import { ToastAlert } from "./ToasterMsg";
import { isObject } from "quickbuilder";

/**
 * apiFetch setup
 */
// apiFetch.use(apiFetch.createNonceMiddleware(api_nonce));
// apiFetch.use(apiFetch.createRootURLMiddleware(rest_url));

class NotificationXHelpers {
    namespace = "/notificationx";
    version = "v1";
    getPath = (path) => {
        return `${this.namespace}/${this.version}/${path}`;
    };
    post = (endpoint, data = {}, args = {}) => {
        let path = this.getPath(endpoint);
        args = { path, method: "POST", data, ...args };
        return apiFetch(args)
            .then((res) => res)
            .catch((err) => console.error(err));
    };
    delete = (endpoint, data = {}, args = {}) => {
        let path = this.getPath(endpoint);
        args = { path, method: "DELETE", data, ...args };
        return apiFetch(args)
            .then((res) => res)
            .catch((err) => console.error(err));
    };
    get = (endpoint, args = {}) => {
        let path = this.getPath(endpoint);
        args = { path, method: "GET", ...args };
        return apiFetch(args)
            .then((res) => res)
            .catch((err) => console.error(err));
    };
    // getData: (args) => {
    //     apiFetch({
    //         path: "/notificationx/v1/get-data",
    //         method: "POST",
    //         data: args?.data,
    //     })
    //         .then((res) => {
    //             console.log("res", res);
    //         })
    //         .catch((err) => console.error(err));
    // },
    useQuery = (search) => {
        search = search;
        return new URLSearchParams(search);
    };
    getParam = (param, d = null) => {
        const query = nxHelper.useQuery(location.search);
        return query.get(param) || d;
    };
    getRedirect = (params: { [key: string]: any }, keepHash = false) => {
        const query = nxHelper.useQuery(location.search);
        const hash =
            keepHash === true
                ? location.hash
                : typeof keepHash == "string"
                ? keepHash
                : "";

        switch (params.page) {
            case "nx-admin":
                query.delete("comparison");
                query.delete("tab");
                query.delete("id");
                break;
            case "nx-edit":
                query.delete("comparison");
                query.delete("tab");
                query.delete("status");
                query.delete("per-page");
                query.delete("p");

                break;
            case "nx-settings":
                query.delete("comparison");
                query.delete("status");
                query.delete("per-page");
                query.delete("p");
                query.delete("id");

                break;
            case "nx-analytics":
                query.delete("tab");
                query.delete("status");
                query.delete("per-page");
                query.delete("p");
                query.delete("id");

                break;
            case "nx-builder":
                query.delete("comparison");
                query.delete("tab");
                query.delete("status");
                query.delete("per-page");
                query.delete("p");
                query.delete("id");

                break;

            default:
                break;
        }

        for (const key in params) {
            query.set(key, params[key]);
        }

        return {
            pathname: "/admin.php",
            search: "?" + query.toString() + hash,
        };
    };
    filtered = (notices, status) => {
        return notices.filter((val) => {
            switch (status) {
                case "enabled":
                    return !!val?.enabled;
                    break;
                case "disabled":
                    return !val?.enabled;
                    break;
                case "all":
                default:
                    return true;
                    break;
            }
        });
    };
    swal = ({
        confirmedCallback,
        completeAction,
        completeArgs,
        afterComplete,
        ...args
    }) => {
        Swal.fire(args).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                confirmedCallback()
                    .then((res) => {
                        if (res?.success) {
                            const result = completeAction(res);
                            const [type, message] = completeArgs(result);
                            ToastAlert(type, message).then(afterComplete);
                        }
                    })
                    .catch((err) => console.error("Delete Error: ", err));
            }
        });
    };
}

const nxHelper = new NotificationXHelpers();

export const SweetAlert = (args: any = {}) => {
    return Swal.mixin({
        target: args?.target ?? "#notificationx",
        type: args?.type ?? "success",
        html: args?.html,
        title: args?.title ?? __("Title Goes Here: title", "notificationx"),
        text: args?.text ?? __("Text Goes Here: text", "notificationx"),
        icon: args?.icon ?? (args?.type || "success"),
        timer: args?.timer ?? null,
        ...args,
    });
};

export const getThemeName = (settings) => {
    let themeName = settings.themes.replace(settings.source + "_", "");
    themeName = themeName.replace(settings.type + "_", "");
    if (settings?.custom_type) {
        themeName = themeName.replace(settings?.custom_type + "_", "");
    }
    return themeName;
};

export const proAlert = (html = null) => {
    let htmlObject = {};
    if (html === null) {
        html = sprintf(
            __(
                "You need to upgrade to the <strong><a href='%s' target='_blank'>Premium Version</a></strong> to use this feature.",
                "notificationx"
            ),
            "http://wpdeveloper.com/in/upgrade-notificationx"
        );
    }
    if (isObject(html)) {
        htmlObject = html;
        html = html.message || html.html;
    }
    let alertOptions = {
        showConfirmButton: false,
        showDenyButton: true,
        type: "warning",
        title: __("Opps...", "notificationx"),
        customClass: {
            actions: "nx-pro-alert-actions",
        },
        denyButtonText: "Close",
        ...htmlObject,
        html,
    };
    return SweetAlert(alertOptions);
};

export const assetsURL = (path = "", admin = true) => {
    const builderContext = useNotificationXContext();
    if (admin) {
        return builderContext.assets.admin + path;
    } else {
        return builderContext.assets.public + path;
    }
};

export const chunkArray = (array, chunkSize) => {
    const result = [];
    for (let i = 0; i < array.length; i += chunkSize) {
        result.push(array.slice(i, i + chunkSize));
    }
    return result;
};

export const dateConvertToHumanReadable = (dateString) => {
    const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' };
    // @ts-ignore 
    return new Date(dateString).toLocaleDateString(undefined, options);
};

export const checkCSVItems = (csvUrl: string): Promise<number> => {
    return new Promise((resolve, reject) => {
        // Ensure the URL is using HTTPS if the current page is HTTPS
        const url = new URL(csvUrl, window.location.href);
        if (window.location.protocol === 'https:' && url.protocol !== 'https:') {
            url.protocol = 'https:';
        }

        const xhr = new XMLHttpRequest();
        xhr.open('GET', url.toString(), true);
        xhr.responseType = 'blob';
        xhr.onload = function() {
            if (xhr.status === 200) {
                const fileReader = new FileReader();
                fileReader.onload = function(event) {
                    const csvContent = event.target?.result as string;
                    const rows = csvContent.split('\n');
                    resolve(rows.length);
                };
                fileReader.onerror = () => reject(new Error('Error reading CSV file.'));
                fileReader.readAsText(xhr.response);
            } else {
                reject(new Error('Error fetching CSV file.'));
            }
        };
        xhr.onerror = () => reject(new Error('Error fetching CSV file.'));
        xhr.send();
    });
};

export default nxHelper;
