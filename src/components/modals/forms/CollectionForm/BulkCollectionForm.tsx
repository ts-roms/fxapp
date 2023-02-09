import { useState } from 'react';
import { BaseForm } from '@app/components/common/forms/BaseForm/BaseForm';
import * as S from './CollectionForm.styles';
import { Button } from '@app/components/common/buttons/Button/Button';
import { mergeBy } from '@app/utils/utils';
import { Col, Row } from 'antd';
import { Input } from '@app/components/common/inputs/Input/Input';
import { useTranslation } from 'react-i18next';
import TextArea from 'antd/lib/input/TextArea';
import { notificationController } from '@app/controllers/notificationController';
import { BulkCollectionTable } from '../../tables/collection/BulkCollectionTable';

interface ICollectionForm {
  open: boolean;
  setOpen: (e: boolean) => void;
}

interface FieldData {
  name: string | number;
  value: any;
}

interface FormValues {
  [key: string]: string | undefined;
}

export const BulkCollectionForm: React.FC<ICollectionForm> = (
  collectionForm: ICollectionForm,
) => {
  const { t } = useTranslation();

  const { open, setOpen } = collectionForm;
  const [isLoading, setIsLoading] = useState(false);
  const [form] = BaseForm.useForm();
  const [fields, setFields] = useState<FieldData[]>([
    { name: 'loanId', value: '' },
    { name: 'amount', value: '' },
    { name: 'receiptNo', value: '' },
    { name: 'collectionDate', value: '' },
    { name: 'description', value: '' },
    { name: 'customFields', value: '' },
  ]);

  const fieldUi: FormValues = {
    loanId: t('forms.fields.field', { name: 'Loan ID' }),
    amount: t('forms.fields.field', { name: 'RePayment Amount' }),
    receiptNo: t('forms.fields.field', { name: 'Receipt No' }),
    collectionDate: t('forms.fields.field', { name: 'Payment Date' }),
    description: t('forms.fields.field', { name: 'Description' }),
    customFields: t('forms.fields.field', { name: 'Custom Fields' }),
  };

  const handleSubmit = (e: any) => {
    e.preventDefault();
    setIsLoading(true);
    form
      .validateFields()
      .then(() => {
        setTimeout(() => {
          notificationController.success({ message: t('common.success') });
          setIsLoading(false);
          setOpen(!open);
        }, 3000);
      })
      .catch(() => {
        notificationController.error({ message: t('common.error') });
        setIsLoading(false);
      });
  };

  return (
    <BaseForm
      name="collectionForm"
      form={form}
      fields={fields}
      onFieldsChange={(_, allFields) => {
        const currentFields = allFields.map((item) => ({
          name: Array.isArray(item.name) ? item.name[0] : '',
          value: item.value,
        }));
        const uniqueData = mergeBy(fields, currentFields, 'name');
        setFields(uniqueData);
      }}
    >
      <S.FormContent>
        <BulkCollectionTable />
      </S.FormContent>
      <S.ActionWrapper>
        <Button
          type="primary"
          onClick={(e) => handleSubmit(e)}
          loading={isLoading}
          style={{
            width: 150,
          }}
        >
          {!isLoading ? 'Submit' : 'Processing...'}
        </Button>
        {!isLoading ? (
          <Button
            onClick={() => setOpen(!open)}
            style={{
              right: 31,
              position: 'absolute',
              width: 150,
            }}
            danger
          >
            Cancel
          </Button>
        ) : null}
      </S.ActionWrapper>
    </BaseForm>
  );
};
