import { Modal } from '@app/components/common/Modal/Modal';
import { BranchesForm } from '../forms/Branches/BranchesForm';

interface IBranchesModal {
  open: boolean;
  setOpen: (e: boolean) => void;
}

const BranchesModal: React.FC<IBranchesModal> = (
  formModal: IBranchesModal,
) => {
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
      title={`Branch Form`}
    >
      <BranchesForm open={open} setOpen={setOpen} />
    </Modal>
  );
};

export default BranchesModal;
