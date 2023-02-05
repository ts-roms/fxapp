import { Modal } from '@app/components/common/Modal/Modal';
import { EmployeeForm } from '../forms/EmployeeForm/EmployeeForm';

interface IStepFormModal {
  open: boolean;
  setOpen: (e: boolean) => void;
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
      title={'Employee Form'}
    >
      <EmployeeForm open={open} setOpen={setOpen} />
    </Modal>
  );
};

export default StepFormModal;
