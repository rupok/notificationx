import React from 'react'
import { Redirect, useLocation, useParams } from 'react-router-dom';
import { BuilderProvider, useBuilder } from '../../../form-builder/src/core/hooks';
import withDocumentTitle from '../../core/withDocumentTitle';
import { useNotificationXContext } from '../../hooks';
import SettingsInner from './SettingsInner';

const SettingsWrapper = (props) => {
    const builder = useBuilder(notificationxTabs.settings);

    return (
        <BuilderProvider value={builder}>
            <SettingsInner />
        </BuilderProvider>
    )
}
export default withDocumentTitle(SettingsWrapper, "Settings");