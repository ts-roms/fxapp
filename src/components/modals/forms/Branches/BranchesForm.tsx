import { useState } from 'react';
import { BaseForm } from '@app/components/common/forms/BaseForm/BaseForm';
import * as S from './BranchesForm.styles';
import { Button } from '@app/components/common/buttons/Button/Button';
import { mergeBy } from '@app/utils/utils';
import { Col, Row } from 'antd';
import { Input, TextArea } from '@app/components/common/inputs/Input/Input';
import { useTranslation } from 'react-i18next';
import { notificationController } from '@app/controllers/notificationController';
import { Spinner } from '@app/components/common/Spinner/Spinner';

interface IBranchesForm {
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

export const BranchesForm: React.FC<IBranchesForm> = (
  collectionForm: IBranchesForm,
) => {
  const { t } = useTranslation();

  const { open, setOpen } = collectionForm;
  const [isLoading, setIsLoading] = useState(false);
  const [form] = BaseForm.useForm();
  const [fields, setFields] = useState<FieldData[]>([
    { name: 'name', value: '' },
    { name: 'note', value: '' }
  ]);

  const fieldUi: FormValues = {
    name: t('forms.fields.field', { name: `Branch Name` }),
    note: t('forms.fields.field', { name: `Note` })
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
    <Spinner spinning={isLoading} size={'large'}>
      <BaseForm
        name={`${name}Form`}
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
          <Row justify={'space-between'} align={'middle'}>
            <Col xxl={12}>
              <BaseForm.Item
                name="name"
                label={fieldUi.name}
                rules={[
                  {
                    required: true,
                    message: t('forms.stepFormLabels.fieldError', {
                      field: `Branch Name`,
                    }),
                  },
                ]}
                style={{
                  width: 320,
                }}
              >
                <Input placeholder={fieldUi.name} />
              </BaseForm.Item>
            </Col>
          </Row>
          <Row justify={'space-between'} align={'middle'}>
            <Col xxl={12}>
              <BaseForm.Item
                name="note"
                label={fieldUi.note}
                style={{
                  width: 420,
                }}
              >
                <TextArea placeholder={fieldUi.note} />
              </BaseForm.Item>
            </Col>
          </Row>
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
    </Spinner>
  );
};
