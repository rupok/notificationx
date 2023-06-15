/**
 * WordPress dependencies
 */
import { __ } from "@wordpress/i18n";
import { useState, useEffect } from "@wordpress/element";
import { InspectorControls, PanelColorSettings } from "@wordpress/block-editor";
import apiFetch from "@wordpress/api-fetch";
import {
  PanelBody,
  SelectControl,
  // ToggleControl,
  // TextControl,
  // TextareaControl,
  Button,
  ButtonGroup,
  BaseControl,
  TabPanel,
} from "@wordpress/components";
import { select } from "@wordpress/data";

/**
 * Internal depencencies
 */
import {
  NX_MARGIN,
  NX_PADDING,
  NX_BORDER,
  UNIT_TYPES,
  TEXT_ALIGN,
  WRAPPER_ALIGN,
} from "./constants";
import { NX_TYPOGRAPHY } from "./typographyConstants";
const {
  // faIcons,
  ResponsiveDimensionsControl,
  TypographyDropdown,
  BorderShadowControl,
  // ResponsiveRangeController,
  // BackgroundControl,
} = window.EBControls;

import objAttributes from "./attributes";

export default function Inspector(props) {
  const { attributes, setAttributes } = props;
  const {
    resOption,
    blockId,
    blockRoot,
    blockMeta,
    nx_id,
    nxColor,
    nxBgColor,
    nxLinkColor,
    nxTextAlign,
    nxWrapperAlign,
  } = attributes;
  const [nx_ids, set_nx_ids] = useState(null);

  const editorStoreForGettingPreivew =
    nx_style_handler.editor_type === "edit-site"
      ? "core/edit-site"
      : "core/edit-post";

  // this useEffect is for setting the resOption attribute to desktop/tab/mobile depending on the added 'eb-res-option-' class only the first time once
  useEffect(() => {
    setAttributes({
      resOption: select(
        editorStoreForGettingPreivew
      ).__experimentalGetPreviewDeviceType(),
    });
  }, []);

  const resRequiredProps = {
    setAttributes,
    resOption,
    attributes,
    objAttributes,
  };
  useEffect(() => {
    apiFetch({ path: "notificationx/v1/nx?per_page=999", method: "GET", }).then((res) => {
      let ids = [];
      if (res?.posts?.length > 0) {
        ids = res.posts
          .filter((item) => item.enabled && item.source != "press_bar" && item.type !== 'inline' && item.type !== 'flashing_tab')
          .map((item) => ({
            label: item?.title || item?.nx_id,
            value: item?.nx_id,
          }));
      }
      set_nx_ids([
        { label: __("Select", "notificationx"), value: "" },
        ...ids,
      ]);
    });
  }, []);
  return (
    <InspectorControls key="controls">
      <div className="eb-panel-control">
        <TabPanel
          className="eb-parent-tab-panel"
          activeClass="active-tab"
          tabs={[
            {
              name: "general",
              title: "General",
              className: "eb-tab general",
            },
            {
              name: "styles",
              title: "Style",
              className: "eb-tab styles",
            },
          ]}
        >
          {(tab) => (
            <div className={"eb-tab-controls" + tab.name}>
              {tab.name === "general" && (
                <div className="eb-panel-control">
                  <div className="nx-panel-body-default">
                    <SelectControl
                      label={__("Choose Notification", "notificationx")}
                      value={nx_id}
                      options={nx_ids}
                      onChange={(selected) =>
                        setAttributes({ nx_id: selected })
                      }
                    />
                    {nx_ids && nx_ids.length <= 1 ? (
                      <>
                        <p className="nx-block-no-nx-notice">
                          <b>{__("Note: ", "notificationx")}</b>
                          {__(
                            "You have no notification enabled. Please Enable notifications to get here.",
                            "notificationx"
                          )}
                        </p>
                      </>
                    ) : (
                      <></>
                    )}
                    <div style={{ marginBottom: 20 }}>
                      <BaseControl label={__("Alignment", "notificationx")}>
                        <ButtonGroup id="eb-advance-heading-alignment">
                          {WRAPPER_ALIGN.map((item) => (
                            <Button
                              key={item.value}
                              isPrimary={nxWrapperAlign === item.value}
                              isSecondary={nxWrapperAlign !== item.value}
                              onClick={() =>
                                setAttributes({
                                  nxWrapperAlign: item.value,
                                })
                              }
                            >
                              {item.label}
                            </Button>
                          ))}
                        </ButtonGroup>
                      </BaseControl>
                      <a href="https://notificationx.com/docs/notificationx-inline-notification-in-gutenberg/" target="_blank">Need Help?</a>
                    </div>
                  </div>
                </div>
              )}
              {tab.name === "styles" && (
                <div className="eb-panel-control">
                  <div className="nx-panel-body-default">
                    <div style={{ marginBottom: 15 }}>
                      <TypographyDropdown
                        baseLabel={__("Typography", "notificationx")}
                        typographyPrefixConstant={NX_TYPOGRAPHY}
                        resRequiredProps={resRequiredProps}
                      />
                    </div>
                    <div style={{ marginBottom: 20 }}>
                      <BaseControl label={__("Alignment", "notificationx")}>
                        <ButtonGroup id="eb-advance-heading-alignment">
                          {TEXT_ALIGN.map((item) => (
                            <Button
                              isPrimary={nxTextAlign === item.value}
                              isSecondary={nxTextAlign !== item.value}
                              onClick={() =>
                                setAttributes({
                                  nxTextAlign: item.value,
                                })
                              }
                            >
                              {item.label}
                            </Button>
                          ))}
                        </ButtonGroup>
                      </BaseControl>
                    </div>
                    <div style={{ marginBottom: 20 }}>
                      <ResponsiveDimensionsControl
                        resRequiredProps={resRequiredProps}
                        controlName={NX_PADDING}
                        baseLabel="Padding"
                      />
                    </div>
                    <div style={{ marginBottom: 20 }}>
                      <ResponsiveDimensionsControl
                        resRequiredProps={resRequiredProps}
                        controlName={NX_MARGIN}
                        baseLabel="Margin"
                      />
                    </div>
                    <PanelColorSettings
                      initialOpen={false}
                      className={"nx-color-control"}
                      title={__("Color", "notificationx")}
                      colorSettings={[
                        {
                          value: nxLinkColor,
                          onChange: (newColor) =>
                            setAttributes({ nxLinkColor: newColor }),
                          label: __("Link Color", "notificationx"),
                        },
                        {
                          value: nxColor,
                          onChange: (newColor) =>
                            setAttributes({ nxColor: newColor }),
                          label: __("Text Color", "notificationx"),
                        },
                        {
                          value: nxBgColor,
                          onChange: (newColor) =>
                            setAttributes({ nxBgColor: newColor }),
                          label: __("Background Color", "notificationx"),
                        },
                      ]}
                    />
                    <PanelBody
                      title={__("Border")}
                      initialOpen={false}
                      className={"nx-color-control"}
                    >
                      <BorderShadowControl
                        controlName={NX_BORDER}
                        resRequiredProps={resRequiredProps}
                        noBdrHover
                        noShdowHover
                      />
                    </PanelBody>
                  </div>
                </div>
              )}
            </div>
          )}
        </TabPanel>
      </div>
    </InspectorControls>
  );
}
