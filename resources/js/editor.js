/**
 * WordPress dependencies.
 */
const { labels } = blockPatternBuilder;

const { __ } = wp.i18n;

const { serialize } = wp.blocks;

const {
	Button,
	Modal,
	TextControl,
	FormTokenField,
	__experimentalNumberControl: NumberControl,
} = wp.components;

const {
	useSelect,
	useDispatch
} = wp.data;

const {
	useEntityProp
} = wp.coreData

const { PluginBlockSettingsMenuItem, PluginDocumentSettingPanel } = wp.editPost;

const { useState } = wp.element;

const { registerPlugin } = wp.plugins;

const BlockPatternBuilder = () => {
	const [isOpen, setOpen] = useState(false);
	const [isLoading, setLoading] = useState(false);
	const [title, setTitle] = useState('');

	const content = useSelect((select) => {
		const { getSelectedBlockCount, getSelectedBlock, getMultiSelectedBlocks } = select('core/block-editor');
		const blocks = 1 === getSelectedBlockCount() ? getSelectedBlock() : getMultiSelectedBlocks();

		return serialize(blocks);
	}, []);

	const { createSuccessNotice } = useDispatch('core/notices');

	const [meta, setMeta] = useEntityProp('postType', 'bpb_pattern', 'meta');
	const {bpb_viewport_width, bpb_keywords} = meta;

	const onSave = () => {
		setLoading(true);

		wp.apiRequest({
			path: 'wp/v2/bpb_pattern',
			method: 'POST',
			data: {
				title,
				content,
				status: 'publish'
			}
		}).then(post => {
			setLoading(false);
			setOpen(false);
			setTitle('');
			createSuccessNotice(labels.createSuccessNotice, {
				type: 'snackbar',
			});
		});
	};

	return (
		<>
			<PluginBlockSettingsMenuItem
				label={labels.menuItem}
				icon={'none'} // We don't want an icon, as new UI of Gutenberg does't have icons for Menu Items, but the component doesn't allow that so we pass an icon which doesn't exist.
				onClick={() => setOpen(true)}
			/>

			{ isOpen && (
				<Modal
					title={labels.modalTitle}
					onRequestClose={() => setOpen(false)}
				>
					<TextControl
						label={labels.modalTextControl}
						value={title}
						onChange={setTitle}
					/>

					<Button
						isPrimary
						isPressed={isLoading}
						isBusy={isLoading}
						onClick={onSave}
					>
						{labels.modalButton}
					</Button>
				</Modal>
			)}

			<PluginDocumentSettingPanel
				name="pattern-builder"
				title="Pattern Settings"
				className="pbp-panel"
				icon={'none'}
			>
				<NumberControl
					value={bpb_viewport_width}
					label="Viewport Width"
					isShiftStepEnabled={true}
					shiftStep={10}
					onChange={(width) => setMeta({bpb_viewport_width: width})}
				/>

				<FormTokenField
					label="Keywords"
					value={bpb_keywords}
					onChange={(keywords) => setMeta({bpb_keywords: keywords})}
				/>
			</PluginDocumentSettingPanel>
		</>
	);
};

registerPlugin('block-pattern-builder', {
	render: BlockPatternBuilder
});
