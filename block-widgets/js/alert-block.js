(function (wp) {
  const registerBlockType = wp.blocks.registerBlockType;
  const InspectorControls = wp.blockEditor.InspectorControls;
  const PanelBody = wp.components.PanelBody;
  const TextControl = wp.components.TextControl;
  const SelectControl = wp.components.SelectControl;
  const ToggleControl = wp.components.ToggleControl;
  const el = wp.element.createElement;

  registerBlockType("widget-demo/alert-block", {
    title: "Alert Block",
    icon: "warning",
    category: "common",
    attributes: {
      message: {
        type: "string",
        default: "This is an alert message!",
      },
      type: {
        type: "string",
        default: "info",
      },
      dismissible: {
        type: "boolean",
        default: false,
      },
    },

    edit: function (props) {
      const attributes = props.attributes;
      const setAttributes = props.setAttributes;

      function onChangeMessage(newMessage) {
        setAttributes({ message: newMessage });
      }

      function onChangeType(newType) {
        setAttributes({ type: newType });
      }

      function onChangeDismissible(newValue) {
        setAttributes({ dismissible: newValue });
      }

      function getIcon(type) {
        const icons = {
          info: "&#9432;",
          success: "&#10004;",
          warning: "&#9888;",
          danger: "&#10006;",
        };
        return icons[type] || icons["info"];
      }

      const dismissButton = attributes.dismissible
        ? '<button class="alert-dismiss"><span aria-hidden="true">×</span></button>'
        : "";

      const htmlString = `
                <div class="alert-block alert-${attributes.type}${attributes.dismissible ? " alert-dismissible" : ""}">
                    <div class="alert-icon">
                        <span>${getIcon(attributes.type)}</span>
                    </div>
                    <div class="alert-content">
                        ${attributes.message}
                    </div>
                    ${dismissButton}
                </div>
            `;

      const messageControl = el(TextControl, {
        label: "Alert Message",
        value: attributes.message,
        onChange: onChangeMessage,
      });

      const typeControl = el(SelectControl, {
        label: "Alert Type",
        value: attributes.type,
        options: [
          { label: "Info", value: "info" },
          { label: "Success", value: "success" },
          { label: "Warning", value: "warning" },
          { label: "Danger", value: "danger" },
        ],
        onChange: onChangeType,
      });

      const dismissibleControl = el(ToggleControl, {
        label: "Dismissible",
        checked: attributes.dismissible,
        onChange: onChangeDismissible,
      });

      const panelBody = el(
        PanelBody,
        {
          title: "Alert Settings",
          initialOpen: true,
        },
        messageControl,
        typeControl,
        dismissibleControl,
      );

      const inspectorControls = el(
        InspectorControls,
        {
          key: "inspector",
        },
        panelBody,
      );

      const previewDiv = el("div", {
        key: "alert-preview",
        dangerouslySetInnerHTML: { __html: htmlString },
      });

      return [inspectorControls, previewDiv];
    },

    save: function () {
      // Rendered via PHP
      return null;
    },
  });
})(window.wp);
