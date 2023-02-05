import { Modal } from '@app/components/common/Modal/Modal';
import { EmployeeForm } from '../Forms/EmployeeForm/EmployeeForm';

interface IStepFormModal {
  open: boolean;
  // eslint-disable-next-line @typescript-eslint/no-explicit-any
  setOpen: any;
}

const StepFormModal: React.FC<IStepFormModal> = (formModal: IStepFormModal) => {
  const { open, setOpen } = formModal;
  return (
    <Modal
      centered
      open={open}
      onCancel={() => setOpen(!open)}
      size="large"
      closable={false}
      footer={null}
      keyboard={false}
      destroyOnClose={true}
      maskClosable={false}
    >
      <EmployeeForm open={open} setOpen={setOpen} />
    </Modal>
  );
};

export default StepFormModal;
