import { Modal } from "@app/components/common/Modal/Modal"
import { CollectionForm } from "../Forms/CollectionForm/CollectionForm";

interface ICollectionModal {
  open: boolean;
  setOpen: (e: boolean) => void;
}

const CollectionModal: React.FC<ICollectionModal> = (formModal: ICollectionModal) => {
  const { open, setOpen } = formModal;
  return (
    <Modal
      centered
      open={open}
      onCancel={() => setOpen(!open)}
      closable={false}
      size={'large'}
      footer={null}
      keyboard={false}
      destroyOnClose={true}
      maskClosable={false}
      title={'Payment Form'}
    >
      <CollectionForm open={open} setOpen={setOpen} />
    </Modal>
  )
}

export default CollectionModal