import { Modal } from '@app/components/common/Modal/Modal';
import { CollectionTypeEnum } from '@app/constants/enums/collectionType';
import { capitalize } from '@app/utils/utils';
import { BulkCollectionForm } from '../forms/CollectionForm/BulkCollectionForm';
import { CollectionForm } from '../forms/CollectionForm/CollectionForm';

interface ICollectionModal {
  open: boolean;
  setOpen: (e: boolean) => void;
  type: string;
}

const CollectionModal: React.FC<ICollectionModal> = (
  formModal: ICollectionModal,
) => {
  const { open, setOpen, type } = formModal;

  const isBulk: boolean = type === CollectionTypeEnum.BULK;

  return (
    <Modal
      centered
      open={open}
      onCancel={() => setOpen(!open)}
      closable={false}
      footer={null}
      keyboard={false}
      destroyOnClose={true}
      maskClosable={false}
      title={`${capitalize(type.toLocaleLowerCase())} Payment Form`}
      width={`${isBulk ? '90' : '50'}%`}
    >
      {!isBulk ? (
        <CollectionForm open={open} setOpen={setOpen} />
      ) : (
        <BulkCollectionForm open={open} setOpen={setOpen} />
      )}
    </Modal>
  );
};

export default CollectionModal;
