import { Modal } from '@app/components/common/Modal/Modal';
import { ChartsOfAccountForm } from '../forms/Accounting/ChartsOfAccountForm';

interface IBranchesModal {
  open: boolean;
  setOpen: (e: boolean) => void;
}

const CharsOfAccountModal: React.FC<IBranchesModal> = (formModal: IBranchesModal) => {
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
      title={`Charts of Account`}
    >
      <ChartsOfAccountForm open={open} setOpen={setOpen} />
    </Modal>
  );
};

export default CharsOfAccountModal;
