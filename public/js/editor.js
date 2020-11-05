/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/editor.js":
/*!********************************!*\
  !*** ./resources/js/editor.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(n); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { if (typeof Symbol === "undefined" || !(Symbol.iterator in Object(arr))) return; var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

/**
 * WordPress dependencies.
 */
var _blockPatternBuilder = blockPatternBuilder,
    labels = _blockPatternBuilder.labels;
var __ = wp.i18n.__;
var serialize = wp.blocks.serialize;
var _wp$components = wp.components,
    Button = _wp$components.Button,
    Modal = _wp$components.Modal,
    TextControl = _wp$components.TextControl,
    FormTokenField = _wp$components.FormTokenField,
    NumberControl = _wp$components.__experimentalNumberControl;
var _wp$data = wp.data,
    useSelect = _wp$data.useSelect,
    useDispatch = _wp$data.useDispatch;
var useEntityProp = wp.coreData.useEntityProp;
var _wp$editPost = wp.editPost,
    PluginBlockSettingsMenuItem = _wp$editPost.PluginBlockSettingsMenuItem,
    PluginDocumentSettingPanel = _wp$editPost.PluginDocumentSettingPanel;
var useState = wp.element.useState;
var registerPlugin = wp.plugins.registerPlugin;

var BlockPatternBuilder = function BlockPatternBuilder() {
  var _useState = useState(false),
      _useState2 = _slicedToArray(_useState, 2),
      isOpen = _useState2[0],
      setOpen = _useState2[1];

  var _useState3 = useState(false),
      _useState4 = _slicedToArray(_useState3, 2),
      isLoading = _useState4[0],
      setLoading = _useState4[1];

  var _useState5 = useState(''),
      _useState6 = _slicedToArray(_useState5, 2),
      title = _useState6[0],
      setTitle = _useState6[1];

  var content = useSelect(function (select) {
    var _select = select('core/block-editor'),
        getSelectedBlockCount = _select.getSelectedBlockCount,
        getSelectedBlock = _select.getSelectedBlock,
        getMultiSelectedBlocks = _select.getMultiSelectedBlocks;

    var blocks = 1 === getSelectedBlockCount() ? getSelectedBlock() : getMultiSelectedBlocks();
    return serialize(blocks);
  }, []);

  var _useDispatch = useDispatch('core/notices'),
      createSuccessNotice = _useDispatch.createSuccessNotice;

  var _useEntityProp = useEntityProp('postType', 'bpb_pattern', 'meta'),
      _useEntityProp2 = _slicedToArray(_useEntityProp, 2),
      meta = _useEntityProp2[0],
      setMeta = _useEntityProp2[1];

  var bpb_viewport_width = meta.bpb_viewport_width,
      bpb_keywords = meta.bpb_keywords;

  var onSave = function onSave() {
    setLoading(true);
    wp.apiRequest({
      path: 'wp/v2/bpb_pattern',
      method: 'POST',
      data: {
        title: title,
        content: content,
        status: 'publish'
      }
    }).then(function (post) {
      setLoading(false);
      setOpen(false);
      setTitle('');
      createSuccessNotice(labels.createSuccessNotice, {
        type: 'snackbar'
      });
    });
  };

  return /*#__PURE__*/React.createElement(React.Fragment, null, /*#__PURE__*/React.createElement(PluginBlockSettingsMenuItem, {
    label: labels.menuItem,
    icon: 'none' // We don't want an icon, as new UI of Gutenberg does't have icons for Menu Items, but the component doesn't allow that so we pass an icon which doesn't exist.
    ,
    onClick: function onClick() {
      return setOpen(true);
    }
  }), isOpen && /*#__PURE__*/React.createElement(Modal, {
    title: labels.modalTitle,
    onRequestClose: function onRequestClose() {
      return setOpen(false);
    }
  }, /*#__PURE__*/React.createElement(TextControl, {
    label: labels.modalTextControl,
    value: title,
    onChange: setTitle
  }), /*#__PURE__*/React.createElement(Button, {
    isPrimary: true,
    isPressed: isLoading,
    isBusy: isLoading,
    onClick: onSave
  }, labels.modalButton)), /*#__PURE__*/React.createElement(PluginDocumentSettingPanel, {
    name: "pattern-builder",
    title: "Pattern Settings",
    className: "pbp-panel",
    icon: 'none'
  }, /*#__PURE__*/React.createElement(NumberControl, {
    value: bpb_viewport_width,
    label: "Viewport Width",
    isShiftStepEnabled: true,
    shiftStep: 10,
    onChange: function onChange(width) {
      return setMeta({
        bpb_viewport_width: width
      });
    }
  }), /*#__PURE__*/React.createElement(FormTokenField, {
    label: "Keywords",
    value: bpb_keywords,
    onChange: function onChange(keywords) {
      return setMeta({
        bpb_keywords: keywords
      });
    }
  })));
};

registerPlugin('block-pattern-builder', {
  render: BlockPatternBuilder
});

/***/ }),

/***/ 0:
/*!**************************************!*\
  !*** multi ./resources/js/editor.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/ajitbohra/Local Sites/wordpress/app/public/wp-content/plugins/block-pattern-builder/resources/js/editor.js */"./resources/js/editor.js");


/***/ })

/******/ });
//# sourceMappingURL=editor.js.map