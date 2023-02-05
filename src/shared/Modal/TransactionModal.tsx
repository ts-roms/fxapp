import { Modal } from '@app/components/common/Modal/Modal';
import { TransactionForm } from '../Forms/TransactionForm/TransactionForm';

interface ITransactionModal {
  open: boolean;
  setOpen: (e: boolean) => void;
}

const TransactionModal: React.FC<ITransactionModal> = (
  formModal: ITransactionModal,
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
      width={'60%'}
      title={'Loan Application Form'}
    >
      <TransactionForm open={open} setOpen={setOpen} />
    </Modal>
  );
};

export default TransactionModal;
