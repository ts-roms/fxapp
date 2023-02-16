import { Modal } from '@app/components/common/Modal/Modal';
import { LoanTypeForm } from '../forms/LoanTypeForm/LoanTypeForm';

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
      width={'70%'}
    >
      <LoanTypeForm open={open} setOpen={setOpen} />
    </Modal>
  );
};

export default LoanTypeModal;
