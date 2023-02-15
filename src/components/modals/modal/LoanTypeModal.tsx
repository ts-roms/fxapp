import { Modal } from '@app/components/common/Modal/Modal';
import { BranchesForm } from '../forms/BranchForm/BranchesForm';

interface IBranchesModal {
  open: boolean;
  setOpen: (e: boolean) => void;
}

const LoanTypeModal: React.FC<IBranchesModal> = (formModal: IBranchesModal) => {
  const { open, setOpen } = formModal;
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
      title={`Loan Type Configuration`}
      width={'90%'}
    >
      <BranchesForm open={open} setOpen={setOpen} />
    </Modal>
  );
};

export default LoanTypeModal;
