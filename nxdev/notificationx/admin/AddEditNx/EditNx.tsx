import { __ } from '@wordpress/i18n';
import React, { useEffect, useState } from 'react'
import { FormBuilder, useBuilderContext } from 'quickbuilder';
import { Content, Instructions, PublishWidget, Sidebar } from '../../components';
import { permissionAlert, proAlert } from '../../core/functions';
import { SourceIcon, DesignIcon, ContentIcon, DisplayIcon, CustomizeIcon, FunctionalIcon, NecessaryIcon, AnalyticsIcon, PerformanceIcon, UncategorizedIcon, ManagerIcon, EditIcon } from '../../icons'

const EditNx = (props) => {
    const { setIsLoading, setIsDelete, id, title, setTitle, setIsUpdated } = props;
    const builderContext = useBuilderContext();

    useEffect(() => {
        let iconLists = {};
        iconLists['source'] = <SourceIcon />
        iconLists['design'] = <DesignIcon />
        iconLists['content'] = <ContentIcon />
        iconLists['display'] = <DisplayIcon />
        iconLists['manager'] = <ManagerIcon />
        iconLists['customize'] = <CustomizeIcon />
        iconLists['necessary'] = <NecessaryIcon />
        iconLists['functional'] = <FunctionalIcon />
        iconLists['analytics'] = <AnalyticsIcon />
        iconLists['performance'] = <PerformanceIcon />
        iconLists['uncategorized'] = <UncategorizedIcon />
        iconLists['edit_modal'] = <EditIcon />
        builderContext.registerIcons('tabs', iconLists);

        builderContext.registerAlert('pro_alert', proAlert);
        builderContext.registerAlert('has_permission_alert', permissionAlert);

    }, [])

    return (
        <>
            <Content>
                <input
                    className="widefat nx-title"
                    type="text"
                    name="title"
                    id="nx-title"
                    placeholder={__("NotificationX Title", 'notificationx')}
                    value={title}
                    onChange={(e) => setTitle(e.target.value)}
                />
                <FormBuilder {...builderContext} />
            </Content>
            <Sidebar>
                <PublishWidget
                    id={props?.id}
                    title={title}
                    isEdit={true}
                    setIsCreated={false}
                    setIsUpdated={setIsUpdated}
                    setIsLoading={setIsLoading}
                    context={builderContext}
                />
                <Instructions  {...builderContext} />
            </Sidebar>
        </>
    )
}

export default EditNx;
