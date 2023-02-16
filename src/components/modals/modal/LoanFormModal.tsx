import { Modal } from '@app/components/common/Modal/Modal';
import { LoanLayoutForm } from '../forms/LoanFormLayoutForm/LoanLayoutForm';

interface IBranchesModal {
  open: boolean;
  setOpen: (e: boolean) => void;
}

const LoanFormModal: React.FC<IBranchesModal> = (formModal: IBranchesModal) => {
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
      title={`Loan Form Configuration`}
      width={'90%'}
    >
      <LoanLayoutForm open={open} setOpen={setOpen} />
    </Modal>
  );
};

export default LoanFormModal;
