import { SelectControl } from "@wordpress/components";
import React, { useState } from "react";
import { Link } from "react-router-dom";
import NavLink from "../components/NavLink";
import nxHelper from "../core/functions";

const NotificationXItemsMenu = ({
    notificationx,
    status,
    perPage,
    totalItems,
    filteredNotice,
    setFilteredNotice,
}) => {
    const [action, setAction] = useState('');
    const bulkAction = () => {
        const selectedItem = filteredNotice.filter((item) => {
            return item?.checked;
        }).map((item) => {
            return item.nx_id;
        });
        nxHelper.post(`nx/bulk-action/${action}`, {
            selectedItem,
        });
    }

    return (
        <div className="nx-admin-menu">
            <ul>
                <li className={status === "all" ? "nx-active" : ""}>
                    <NavLink status="all" perPage={perPage}>All ({totalItems?.all})</NavLink>
                </li>
                <li className={status === "enabled" ? "nx-active" : ""}>
                    <NavLink status="enabled" perPage={perPage}>
                        Enabled ({totalItems?.enabled})
                    </NavLink>
                </li>
                <li className={status === "disabled" ? "nx-active" : ""}>
                    <NavLink status="disabled" perPage={perPage}>
                        Disabled ({totalItems?.disabled})
                    </NavLink>
                </li>
            </ul>
            <div className="nx-bulk-action-wrapper">
                <SelectControl
                    className="bulk-action-select"
                    value={action}
                    onChange={(val) => {
                        setAction(val);
                    }}
                    options={[
                        { value: "", label: "Bulk Action" },
                        { value: "delete", label: "Delete" },
                        { value: "regenerate", label: "Regenerate" },
                    ]}
                />
                <button className="nx-bulk-action-button" onClick={bulkAction}>Apply</button>
            </div>
        </div>
    );
};

export default NotificationXItemsMenu;
